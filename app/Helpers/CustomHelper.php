<?php

use App\Models\BannerModel;
use App\Models\CategoryModel;
use App\Models\DiscordModel;
use App\Models\OptionsModel;
use App\Models\PaymentHistoryModel;
use App\Models\ProductModel;
use App\Models\UpdateVersionModel;
use App\Models\VoucherModel;
use App\Models\VoucherTypeModel;
use App\Models\VoucherUsage;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

if (!function_exists('getName')) {
    function getName($id, $css = NULL)
    {
        $html = '';

        return $html;
    }

    function SEOSON(
        $title = 'Trang chủ',
        $description = 'Stella Studio là một nền tảng hỗ trợ cho các nhà phát triển Minecraft, cung cấp một loạt các công cụ và tài nguyên để tạo ra nội dung tùy chỉnh trong trò chơi.',
        $keywords = 'Stella Studio,Minecarft Stella, hỗ trợ tạo plugin, map, config, pack',
        $image = NULL
    ) {

        // Thiết lập tiêu đề trang
        if ($title) {
            SEOTools::setTitle($title);
        }

        // Thiết lập mô tả trang
        if ($description) {
            if (strlen($description) >= 250) {
                $description = substr($description, 0, 250);
            }
            SEOTools::setDescription($description);
        }
        $keywords = $keywords !== null ? $keywords : 'Stella Studio,Minecarft Stella, hỗ trợ tạo plugin, map, config, pack';
        if (is_array($keywords)) {
            // Thiết lập keyword cho trang
            if ($keywords) {
                SEOTools::metatags()->setKeywords($keywords);
            }
        } else {
            // Nếu $keywords không phải là mảng, thực hiện tách thành mảng
            $keywordArray = [$keywords];
            if ($keywordArray) {
                SEOTools::metatags()->setKeywords($keywordArray);
            }
        }
        if ($image == NULL) {
            $image = asset('assets/clients/images/background/banner.webp');
        }
        // Thiết lập ảnh cho Open Graph và Twitter Card
        if ($image) {
            SEOTools::opengraph()->addImage($image, ['height' => 575, 'width' => 288]);
            SEOTools::twitter()->setImage($image);
        }
        SEOTools::setTitle('' . $title . '');
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl(request()->fullUrl());
        SEOTools::setCanonical(request()->fullUrl());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@thanhson');
    }

    function getOption($name)
    {
        $option = OptionsModel::where('name', $name)->first();
        return $option ? $option->value : null;
    }
    function showAlert()
    {
        $error_count = 0;
        if (session('success_message')) {
            alert()->success('Thành công!', session('success_message'));
        }
        if (session('error_message')) {
            $errors = session('error_message');
            if ($errors instanceof \Illuminate\Support\MessageBag) {
                foreach ($errors->all() as $error) {
                    alert()->html('Lỗi', $error, 'error');
                }
            } elseif (is_string($errors)) {
                alert()->html('Lỗi', $errors, 'error');
            } else {
                alert()->html('Lỗi', var_export($errors, true), 'error');
            }
        }
    }

    function getLogo()
    {
        $image = getOption('DB_LOGO_URL');
        if ($image) {
            return getImage($image);
        } else {
            return asset('assets/clients/images/logo/logo-1.png');
        }
    }
    function countBuyProduct($id)
    {
        if ($id) {
            return DB::table('orders')->where('user_id', $id)->where('order_status', 'PAID')->count();
        }
        return 0;
    }
    function countTable($table)
    {
        if ($table) {
            return DB::table($table)->count();
        }
        return 0;
    }
    function vIpInfo($type = 'default')
    {
        $ip = null;

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } elseif (isset($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }

        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            $ip = '127.0.0.1';
        }

        if (Cache::has($ip) && !Cache::has('null')) {
            $ipInfo = Cache::get($ip);
            if ($ipInfo) {
                $data['regionName'] = $ipInfo->region ?? ""; //Đồng Nai Province
                $data['ip'] = $ipInfo->query ?? $ip; //14.176.117.248
                $data['country'] = $ipInfo->country ?? "NULL"; //VN
                $data['country_code'] = $ipInfo->country ?? "NULL"; //VN
                $data['timezone'] = $ipInfo->timezone ?? "NULL"; //Asia/Ho_Chi_Minh
                $data['city'] = $ipInfo->region ?? "NULL"; //Đồng Nai Province
                $data['zip'] = $ipInfo->postal ?? "NULL"; //76199
                $loc = $ipInfo->loc ?? "NULL"; // 10.9447,106.8243
                $latitude = NULL;
                $longitude = NULL;
                if ($loc && strpos($loc, ',') !== false) {
                    list($latitude, $longitude) = explode(',', $loc);
                }
                $data['latitude'] = $latitude ?? "NULL"; // 10.9447
                $data['longitude'] = $longitude ?? "NULL"; //106.8243
                $data['location'] = $data['city'] . ', ' . $data['regionName'] . ', ' . $data['country'];
                $data['currency'] = $ipInfo->currency ?? "NULL";
                $data['proxy'] = $ipInfo->proxy ?? "NULL";
            }
        } else {
            $data = []; // Khởi tạo mảng dữ liệu
            if ($type == 'default') {
                //max 50k request
                $ipInfo = Cache::rememberForever($ip, function () use ($ip) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "ipinfo.io/{$ip}");
                    curl_setopt(
                        $ch,
                        CURLOPT_HTTPHEADER,
                        array(
                            'Authorization: Bearer 8621086453636c'
                        )
                    );
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    return (object) json_decode($response, true);
                });

                $data['regionName'] = $ipInfo->region ?? ""; //Đồng Nai Province
                $data['ip'] = $ipInfo->query ?? $ip; //14.176.117.248
                $data['country'] = $ipInfo->country ?? "NULL"; //VN
                $data['country_code'] = $ipInfo->country ?? "NULL"; //VN
                $data['timezone'] = $ipInfo->timezone ?? "NULL"; //Asia/Ho_Chi_Minh
                $data['city'] = $ipInfo->region ?? "NULL"; //Đồng Nai Province
                $data['zip'] = $ipInfo->postal ?? "NULL"; //76199
                $loc = $ipInfo->loc ?? "NULL"; // 10.9447,106.8243
                $latitude = NULL;
                $longitude = NULL;
                if ($loc && strpos($loc, ',') !== false) {
                    list($latitude, $longitude) = explode(',', $loc);
                }
                $data['latitude'] = $latitude ?? "NULL"; // 10.9447
                $data['longitude'] = $longitude ?? "NULL"; //106.8243
                $data['location'] = $data['city'] . ', ' . $data['regionName'] . ', ' . $data['country'];
                $data['currency'] = $ipInfo->currency ?? "NULL";
                $data['proxy'] = $ipInfo->proxy ?? "NULL";
            }
            if ($type == 'ip-api.com') {
                //max 40 request
                $fields = "status,country,countryCode,city,zip,lat,lon,timezone,currency,proxy,query,regionName";
                $ipInfo = Cache::rememberForever($ip, function () use ($ip, $fields) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/{$ip}?fields={$fields}");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    return (object) json_decode($response, true);
                });
                $data['regionName'] = $ipInfo->regionName ?? "";
                $data['ip'] = $ipInfo->query ?? $ip;
                $data['country'] = $ipInfo->country ?? "NULL";
                $data['country_code'] = $ipInfo->countryCode ?? "NULL";
                $data['timezone'] = $ipInfo->timezone ?? "NULL";
                $data['city'] = $ipInfo->city ?? "NULL";
                $data['zip'] = $ipInfo->zip ?? "NULL";
                $data['latitude'] = $ipInfo->lat ?? "NULL";
                $data['longitude'] = $ipInfo->lon ?? "NULL";
                $data['location'] = $data['city'] . ', ' . $data['regionName'] . ', ' . $data['country'];
                $data['currency'] = $ipInfo->currency ?? "NULL";
                $data['proxy'] = $ipInfo->proxy ?? NULL;
            }
        }

        // Thêm type vào mảng dữ liệu
        $data['type'] = $type;
        return (object) $data;
    }


    function vBrowser()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $browsers = [
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edg/i' => 'Edge',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/brave/i' => 'Brave',
            '/vivaldi/i' => 'Vivaldi',
            '/ucbrowser/i' => 'UC Browser',
            '/samsungbrowser/i' => 'Samsung Internet',
            '/yandex/i' => 'Yandex Browser',
            '/duckduckgo/i' => 'DuckDuckGo',
            '/tor/i' => 'Tor Browser',
            '/mobile/i' => 'Handheld Browser',
            '/115browser/i' => '115 Browser',
            '/2345explorer/i' => '2345 Explorer',
            '/360securebrowser/i' => '360 Secure Browser',
            '/360extremebrowser/i' => '360 Extreme Browser',
            '/acentbrowser/i' => 'Acent Browser',
            '/adawaresafebrowser/i' => 'Adaware Safe Browser',
            '/agregorebrowser/i' => 'Agregore Browser',
            '/alloybrowser/i' => 'Alloy Browser',
            '/alohabrowser/i' => 'Aloha Browser',
            '/ampbrowser/i' => 'AMP Browser',
            '/arcbrowser/i' => 'Arc Browser',
            '/arcticfoxbrowser/i' => 'Arctic Fox Web Browser',
            '/artisbrowser/i' => 'ArtisBrowser',
            '/asobi/i' => 'Asobi',
            '/atombrowser/i' => 'Atom Browser',
            '/avastsecurebrowser/i' => 'Avast Secure Browser',
            '/avgsecurebrowser/i' => 'AVG Secure Browser',
            '/axplorer/i' => 'AXplorer',
            '/badwolfbrowser/i' => 'BadWolf Browser',
            '/basiliskbrowser/i' => 'Basilisk Browser',
            '/beaconbrowser/i' => 'Beacon Browser',
            '/beakerbrowser/i' => 'Beaker Browser',
            '/beam/i' => 'Beam',
            '/biscuit/i' => 'Biscuit',
            '/blisk/i' => 'Blisk',
            '/bluehawk/i' => 'Blue Hawk',
            '/bonbonbrowser/i' => 'BonBon Browser',
            '/bonsai/i' => 'Bonsai',
            '/borneobrowser/i' => 'Borneo Browser',
            '/bravebrowser/i' => 'Brave Browser',
            '/briskbard/i' => 'BriskBard',
            '/browserjet/i' => 'BrowserJet',
            '/browsh/i' => 'Browsh',
            '/cachybrowser/i' => 'Cachy Browser',
            '/camino/i' => 'Camino',
            '/carbon/i' => 'Carbon',
            '/carbonyl/i' => 'Carbonyl',
            '/catalyst/i' => 'Catalyst',
            '/catsxpbrowser/i' => 'Catsxp Browser',
            '/centbrowser/i' => 'CentBrowser',
            '/chedot/i' => 'Chedot',
            '/chromium/i' => 'Chromium',
            '/chromiumgost/i' => 'Chromium-Gost',
            '/chromnius/i' => 'Chromnius',
            '/citriobrowser/i' => 'Citrio Browser',
            '/cococbrowser/i' => 'Cốc Cốc Browser',
            '/cocoonbrowser/i' => 'Cocoon Browser',
            '/colibribrowser/i' => 'Colibri Browser',
            '/comododragon/i' => 'Comodo Dragon',
            '/coowon/i' => 'Coowon',
            '/corebrowser/i' => 'Core Browser',
            '/cromite/i' => 'Cromite',
            '/cruz/i' => 'Cruz',
            '/cryptotabbrowser/i' => 'CryptoTab Browser',
            '/cyberghostbrowser/i' => 'CyberGhost Browser',
            '/dashob/i' => 'Dashob',
            '/dbrowser/i' => 'dBrowser',
            '/decentrbrowser/i' => 'Decentr Browser',
            '/dezor/i' => 'Dezor',
            '/dillobrowser/i' => 'Dillo Browser',
            '/dissenterbrowser/i' => 'Dissenter Browser',
            '/dooblebrowser/i' => 'Dooble Browser',
            '/dotbrowser/i' => 'Dot Browser',
            '/duckduckgobrowser/i' => 'DuckDuckGo Browser',
            '/elzabrowser/i' => 'Elza Browser',
            '/epicbrowser/i' => 'Epic Browser',
            '/epiphany/i' => 'Epiphany',
            '/falkon/i' => 'Falkon Browser',
            '/fastback/i' => 'FastBack',
            '/fifobrowser/i' => 'Fifo Browser',
            '/firedragon/i' => 'FireDragon Browser',
            '/firefoxdeveloper/i' => 'Firefox Browser Developer Edition',
            '/flashbrowser/i' => 'Flash Browser',
            '/floorpbrowser/i' => 'Floorp Browser',
            '/flowbrowser/i' => 'Flow Browser',
            '/gener8browser/i' => 'Gener8 Browser',
            '/ghostbrowser/i' => 'Ghost Browser',
            '/ghosterybrowser/i' => 'Ghostery Browser',
            '/glowbrowser/i' => 'Glow Browser',
            '/googlechrome/i' => 'Google Chrome',
            '/gnuicecat/i' => 'GNU IceCat',
            '/guardianbrowser/i' => 'Guardian Browser',
            '/hayamibrowser/i' => 'Hayami Browser',
            '/helium/i' => 'Helium',
            '/holabrowser/i' => 'Hola Browser',
            '/impervious/i' => 'Impervious',
            '/interweb/i' => 'InterWeb',
            '/iridiumbrowser/i' => 'Iridium Browser',
            '/jumanji/i' => 'jumanji',
            '/kaktus/i' => 'Kaktus',
            '/kingpinbrowser/i' => 'Kingpin Browser',
            '/kristall/i' => 'kristall',
            '/kmeleon/i' => 'K-Meleon',
            '/ladybird/i' => 'Ladybird',
            '/lagrange/i' => 'Lagrange',
            '/leechcraft/i' => 'LeechCraft',
            '/librewolf/i' => 'LibreWolf',
            '/lightbrowser/i' => 'Light Browser',
            '/links/i' => 'Links',
            '/liri/i' => 'Liri Browser',
            '/loboevolution/i' => 'LoboEvolution',
            '/localbrowser/i' => 'Local Browser',
            '/ltbrowser/i' => 'LT Browser',
            '/luakit/i' => 'Luakit',
            '/lulumibrowser/i' => 'Lulumi Browser',
            '/lunascapebrowser/i' => 'Lunascape Browser',
            '/lynx/i' => 'Lynx',
            '/mercurybrowser/i' => 'Mercury Browser',
            '/microsoftedge/i' => 'Microsoft Edge',
            '/midori/i' => 'Midori Browser',
            '/milkshake/i' => 'MilkShake',
            '/minbrowser/i' => 'Min Browser',
            '/minichromebrowser/i' => 'Minichrome Browser',
            '/minumbrowser/i' => 'Minum Browser',
            '/mitrabrowser/i' => 'Mitra Browser',
            '/mullvadbrowser/i' => 'Mullvad Browser',
            '/multizenbrowser/i' => 'Multizen Browser',
            '/mypalbrowser/i' => 'Mypal Browser',
            '/naverwhalebrowser/i' => 'Naver Whale Browser',
            '/neriven/i' => 'Neriven',
            '/netsurf/i' => 'NetSurf',
            '/netsurfer/i' => 'NetSurfer',
            '/nexusbrowser/i' => 'Nexus Browser',
            '/ninetails/i' => 'Ninetails',
            '/nosbrowser/i' => 'nOS',
            '/nyxtbrowser/i' => 'Nyxt browser',
            '/ohhaibrowser/i' => 'OhHai Browser',
            '/operaone/i' => 'Opera One [Early access]',
            '/operagx/i' => 'Opera GX',
            '/operacryptobrowser/i' => 'Opera Crypto Browser',
            '/orbitumbrowser/i' => 'Orbitum Browser',
            '/orionbrowser/i' => 'Orion Browser',
            '/oryoki/i' => 'ōryōki',
            '/otterbrowser/i' => 'Otter Browser',
            '/palemoon/i' => 'Pale Moon',
            '/pennywise/i' => 'Pennywise',
            '/plasmafoxbrowser/i' => 'PlasmaFox Browser [ARCHIVED]',
            '/pocketbrowser/i' => 'Pocket Browser',
            '/polaritybrowser/i' => 'Polarity Browser',
            '/polybrowser/i' => 'PolyBrowser',
            '/polypane/i' => 'Polypane',
            '/powerbrowser/i' => 'Power Browser',
            '/programmerbrowser/i' => 'Programmer Browser',
            '/puffinbrowser/i' => 'Puffin Browser',
            '/pulsebrowser/i' => 'Pulse Browser',
            '/qinghubrowser/i' => 'Qinghu Browser',
            '/qqbrowser/i' => 'QQ Browser',
            '/qtwebinternetbrowser/i' => 'QtWeb Internet Browser [Discontinued]',
            '/qutebrowser/i' => 'qutebrowser',
            '/roccatbrowser/i' => 'Roccat Browser',
            '/sanbrowser/i' => 'Sanbrowser',
            '/sandcatbrowser/i' => 'Sandcat Browser',
            '/sealion/i' => 'Shift',
            '/sidekickbrowser/i' => 'Sidekick Browser',
            '/sielobrowser/i' => 'Sielo Browser [Archived]',
            '/sigmaosbrowser/i' => 'SigmaOS Browser',
            '/sizzy/i' => 'Sizzy',
            '/skye/i' => 'Skye',
            '/slashb/i' => 'slashB',
            '/sleipnirbrowser/i' => 'Sleipnir Browser',
            '/slimbrowser/i' => 'SlimBrowser',
            '/slimjetbrowser/i' => 'Slimjet Browser',
            '/sogouexplorer/i' => 'Sogou Explorer',
            '/spherebrowser/i' => 'Sphere Browser',
            '/splitbrowser/i' => 'Split Browser',
            '/sputnik/i' => 'Sputnik',
            '/srwareironbrowser/i' => 'SRWare Iron Browser',
            '/stackbrowser/i' => 'Stack Browser',
            '/station/i' => 'Station',
            '/surf/i' => 'surf',
            '/sushibrowser/i' => 'sushi-browser',
            '/synth/i' => 'Synth',
            '/tempestbrowser/i' => 'Tempest Browser',
            '/teslabrowser/i' => 'Tesla Browser',
            '/theclassicbrowser/i' => 'The Classic Browser',
            '/theweb/i' => 'theWeb',
            '/thoriumbrowser/i' => 'Thorium Browser',
            '/torbrowser/i' => 'Tor Browser',
            '/tuskbrowser/i' => 'Tusk Browser',
            '/ulaabrowser/i' => 'Ulaa Browser',
            '/undetectablebrowser/i' => 'Undetectable Browser',
            '/ungoogledchromium/i' => 'Ungoogled Chromium',
            '/unstoppableblockchainbrowser/i' => 'Unstoppable Blockchain Browser [Archived]',
            '/urbrowser/i' => 'UR Browser',
            '/uzblbrowser/i' => 'Uzbl Browser [Discontinued]',
            '/viasatbrowser/i' => 'Viasat Browser',
            '/vieb/i' => 'Vieb',
            '/vimb/i' => 'Vimb',
            '/visurf/i' => 'visurf',
            '/vivaldibrowser/i' => 'Vivaldi Browser',
            '/w3m/i' => 'w3m',
            '/waterfox/i' => 'Waterfox',
            '/wavebrowser/i' => 'Wave Browser',
            '/waveboxbrowser/i' => 'Wavebox Browser',
            '/webbuddy/i' => 'WebBuddy',
            '/webianshell/i' => 'Webian Shell',
            '/webnetofficial/i' => 'WebNet Official',
            '/websmbrowser/i' => 'WebSM Browser',
            '/wexondbrowser/i' => 'Wexond Browser [Archived]',
            '/xvastbrowser/i' => 'Xvast Browser',
            '/y8browser/i' => 'Y8 Browser',
            '/yaebbrowser/i' => 'Yaeb Browser',
            '/yandexbrowser/i' => 'Yandex Browser',
        ];
        $agent_browser = "NULL";

        foreach ($browsers as $key => $value) {
            if (preg_match($key, $agent)) {
                $agent_browser = $value;
            }
        }

        return $agent_browser;
    }

    function vPlatform()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $platforms = [
            '/windows nt 11/i' => 'Windows 11',
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android 14/i' => 'Android 10',
            '/android 13/i' => 'Android 10',
            '/android 12/i' => 'Android 10',
            '/android 11/i' => 'Android 10',
            '/android 10/i' => 'Android 10',
            '/android 9/i' => 'Android 9',
            '/android 8/i' => 'Android 8',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile',
            '/chrome os/i' => 'Chrome OS',
            '/fedora/i' => 'Fedora',
            '/freebsd/i' => 'FreeBSD',
            '/openbsd/i' => 'OpenBSD',
            '/netbsd/i' => 'NetBSD',
            '/dragonflybsd/i' => 'DragonFly BSD',
            '/solaris/i' => 'Solaris',
            '/aix/i' => 'AIX',
            '/raspbian/i' => 'Raspbian',
            '/centos/i' => 'CentOS',
            '/redhat/i' => 'Red Hat',
        ];
        $agent_platform = "NULL";
        foreach ($platforms as $key => $value) {
            if (preg_match($key, $agent)) {
                $agent_platform = $value;
            }
        }
        return $agent_platform;
    }

    function formatBytes($bytes, $precision = 2)
    {
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1024;
        $gigabyte = $megabyte * 1024;

        if ($bytes < $kilobyte) {
            return $bytes . ' B';
        } elseif ($bytes < $megabyte) {
            return round($bytes / $kilobyte, $precision) . ' KB';
        } elseif ($bytes < $gigabyte) {
            return round($bytes / $megabyte, $precision) . ' MB';
        } else {
            return round($bytes / $gigabyte, $precision) . ' GB';
        }
    }

    function getBannerPage($page)
    {
        if ($page) {
            $banner = BannerModel::where('status', 1)->where('page', $page)->first();
            if ($banner) {
                return $banner->image;
            }
        }
        return null;
    }

    function getImage($image,$type="default")
    {
        $urlComponents = parse_url($image);
        if (isset($urlComponents['scheme']) && in_array($urlComponents['scheme'], ['http', 'https'])) {
            return $image;
        } else {
            $basePath = env('APP_URL');

            if (strpos($image, '/') === 0) {
                return $basePath . '/' . ltrim($image, '/');
            } else {
                return $basePath . '/' . $image;
            }
        }
    }

    function html_decode($text)
    {
        $after_decode =  htmlspecialchars_decode($text, ENT_QUOTES);
        return $after_decode;
    }
    function html_encode($text)
    {
        $text = strip_tags($text, '<span><p><a><b><i><u><strong><br><hr><table><tr><th><td><ul><ol><li><h1><h2><h3><h4><h5><h6><del><ins><sup><sub><pre><address><img><figure><embed><iframe><video><style>');

        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        return $text;
    }

    function noti($notification, $type)
    {
        return [
            'message' => $notification,
            'alert-type' => $type
        ];
    }

    function typeAccount($user)
    {
        if ($user->role == 1) {
            return 'Nhân viên';
        } else if ($user->role == 10) {
            return 'Admin';
        } else {
            return 'Thành viên';
        }
    }

    function getNameCategory($id)
    {
        $category = CategoryModel::find($id);
        return $category ? $category->name : null;
    }
    function calculateDiscountPercent($newPrice, $oldPrice)
    {
        if ($oldPrice <= 0) {
            return 0;
        }

        $percentDiscount = (($oldPrice - $newPrice) / $oldPrice) * 100;
        return round($percentDiscount, 0) . '%';
    }
    function getCategory()
    {
        $category = CategoryModel::where('status', 1)->where('parent_id', 0)->get();
        return $category;
    }
    // function getRender($path, $data = [])
    // {
    //     $cacheKey = 'view_' . md5($path . serialize($data));

    //     return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($path, $data) {
    //         if (view()->exists($path)) {
    //             return view($path, $data)->render();
    //         } else {
    //             return "View '$path' không tồn tại.";
    //         }
    //     });
    // }
    function getRender($path, $data = [])
    {
        if (view()->exists($path)) {
            return view($path, $data)->render();
        } else {
            return "View '$path' không tồn tại.";
        }
    }

    function set2FAEnabled()
    {
        $expiration = now()->addYear();
        $twoFAEnabled = false;

        // Lưu vào session
        session(['2fa_enabled' => $twoFAEnabled]);
        session(['2fa_enabled_expiration' => $expiration]);

        // Lưu vào cookies
        Cookie::queue('2fa_enabled', $twoFAEnabled, 525600); // 525600 phút = 1 năm
        Cookie::queue('2fa_enabled_expiration', $expiration->timestamp, 525600);
    }
    function set2PWEnabled()
    {
        $expiration = now()->addYear();
        $twoFAEnabled = false;

        // Lưu vào session
        session(['2pw_enabled' => $twoFAEnabled]);
        session(['2pw_enabled_expiration' => $expiration]);

        // Lưu vào cookies
        Cookie::queue('2pw_enabled', $twoFAEnabled, 525600); // 525600 phút = 1 năm
        Cookie::queue('2fpw_enabled_expiration', $expiration->timestamp, 525600);
    }

    function getStatusOrder($text)
    {
        $statusHtml = '';

        switch ($text) {
            case 'PAID':
                $statusHtml = "Đã thanh toán";
                break;
            case 'CANCELED':
                $statusHtml = "Đã huỷ";
                break;
            case 'PENDING':
                $statusHtml = "Chưa thanh toán";
                break;
            default:
                break;
        }

        return $statusHtml;
    }
    function limitText($text, $limit = 100, $end = '...')
    {
        if (mb_strlen($text) <= $limit) {
            return $text;
        }
        return rtrim(mb_substr($text, 0, $limit, 'UTF-8')) . $end;
    }
    function formatDateForDatePicker($date)
    {
        return $date ? Carbon::parse($date)->format('d/m/Y') : '';
    }

}
