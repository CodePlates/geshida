<?php 

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;
use App\SettingsModel;

class SettingsManager 
{
	const CACHE_KEY = 'app.settings';
	private static $settings = null;

	public function load()
	{
		if (is_null(self::$settings)) {
			self::$settings = Cache::remember(self::CACHE_KEY, 60, function() {
				return SettingsModel::pluck('value', 'key')->toArray();
			});
		}
		
		return self::$settings;
	}

	public function get($key, $default = '')
	{
		/*
		 * TODO: handle autoload false
		 */
		$settings = $this->load();
		return Arr::get($settings, $key, $default);
	}

	public function set($key, $value)
	{
		$setting = SettingsModel::firstOrNew(['key' => $key]);
      $setting->value = $value;
      $setting->save();

      Arr::set(self::$settings, $key, $value);
      Cache::put(self::CACHE_KEY, self::$settings, 60);
	}

	public function append($key, $value)
	{
		$setting = SettingsModel::firstOrNew(['key' => $key]);
      $values = $setting->value;

      if (is_null($values))
      	$values = [];
      if (!is_array($values))
      	return;

      $values[] = $value;
      $setting->value = $values;
      $setting->save();

      Arr::set(self::$settings, $key, $values);
      Cache::put(self::CACHE_KEY, self::$settings, 60);
	}

	public function remove($key, $value)
	{
		// FIXME: switch to using keys for settings values
		$setting = SettingsModel::firstOrNew(['key' => $key]);
      $values = $setting->value;

      if (is_null($values))
      	$values = [];
      if (!is_array($values))
      	return;

      if (($index = array_search($value, $values)) !== false) {
      	unset($values[$index]);
      }
      $setting->value = $values;
      $setting->save();

      Arr::set(self::$settings, $key, $values);
      Cache::put(self::CACHE_KEY, self::$settings, 60);
	}
}