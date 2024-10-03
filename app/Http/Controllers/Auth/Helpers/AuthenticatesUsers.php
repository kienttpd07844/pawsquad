<?php

namespace App\Http\Controllers\Auth\Helpers;

use Illuminate\Http\Request;

trait AuthenticatesUsers
{
	protected function credentials(Request $request)
	{
		return $request->only($this->username(), 'password');
	}
	public function username()
	{
		return 'email';
	}
}
