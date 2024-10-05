<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    use HasFactory;
    protected $table = 'attribute_sets';
    protected $fillable = ['name','slug'];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($attributeSet) {
            // Ngăn không cho xoá nhóm thuộc tính mặc định
            if ($attributeSet->id == self::defaultAttributeSet()->id) {
                throw new \Exception("Không thể xoá nhóm thuộc tính này.");
            }

            // Chuyển các thuộc tính con sang nhóm thuộc tính mặc định
            $defaultAttributeSet = self::defaultAttributeSet();
            $attributeSet->attributes()->update(['attribute_set_id' => $defaultAttributeSet->id]);
        });
    }
    public static function defaultAttributeSet()
    {
        return self::firstOrCreate(['slug' => 'defaultattributeset'], [
            'name' => 'Mặc định',
            'slug' => 'defaultattributeset',
        ]);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'attribute_set_id');
    }
}
