<?php

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

if (!function_exists('carbonParse')) {
    /**
     * Convert Array into Object in deep
     *
     * @param string|null $datetime
     * @param string|DateTimeZone|null $timezone
     * @param string|null $locale
     * @param string $isoFormat
     * @param string|null $format
     * @param bool $showTz
     * @param bool $isReturnIsoFormat
     * @return string|Carbon
     */
    function carbonParse(
        string|null              $datetime = null,
        string|DateTimeZone|null $timezone = null,
        string                   $locale = null,
        string                   $isoFormat = 'll LT',
        string|null              $format = null,
        bool                     $showTz = false,
        bool                     $isReturnIsoFormat = false,
    ): string|Carbon
    {
        if (auth()->check()) {
            /** @var User $user */
            $user = auth()->user();
            if (!$timezone && ($user?->timezone ?? null)) {
                $timezone = $user->timezone;
            }
            if (!$locale && ($user?->locale ?? null)) {
                $locale = $user->locale;
            }
        } else {
            if (is_null($locale)) {
                $locale = config('app.locale');
            }

            if (is_null($timezone)) {
                $timezone = config('app.timezone');
            }
        }

        $timezoneSuffix = match (Str::slug($timezone)) {
            'asiajakarta',
            '0700' => 'WIB',
            'asiamakassar',
            '0800' => 'WITA',
            'asiajayapura',
            '0900' => 'WIT',
            default => ($showTz ? $timezone : ''),
        };

        try {
            Carbon::setLocale($locale);
        } catch (Exception $e) {
            //
        }

        if (!empty($datetime)) {
            $datetime = Carbon::parse($datetime)->locale($locale)->timezone($timezone);
            if (!$isReturnIsoFormat) {
                return $datetime;
            }
        }

        if ($format) {
            return "{$datetime->format($format)} {$timezoneSuffix}";
        }
        if ($datetime instanceof Carbon && $isReturnIsoFormat) {
            return "{$datetime->isoFormat($isoFormat)} {$timezoneSuffix}";
        }
        return Carbon::now()->locale($locale)->timezone($timezone);
    }
}


if (!function_exists('getFillableAttribute')) {

    /**
     * Convert Array into Object in deep
     *
     * @param string $model
     * @param array $data
     * @return array
     */
    function getFillableAttribute(string $model, array $data): array
    {
        $fillable = (new $model)->getFillable();

        return Arr::only($data, Arr::flatten($fillable));
    }
}

if (!function_exists('sanitizePhone')) {
    /**
     * @param string $phone
     * @param string $dial
     *
     * @return string|null
     */
    function sanitizePhone(string $phone, string $dial = '+62'): string|null
    {
        $phone = str($phone)
            ->trim()
            ->replaceMatches('/[^+0-9]/', '')
            ->replaceMatches('/^\++/', '+')
            ->replaceMatches('/^(0|6262|\+6262|62|\+62)(\d+)/', "{$dial}\$2")
            ->replaceMatches('/^(?!\+)(\d+)/', "{$dial}\$1")
            ->toString();
        return $phone == $dial ? null : $phone;
    }
}


if (! function_exists('setDefaultRequest')) {
    /**
     * Set Default Value for Request Input.
     *
     * @param string|array $name
     * @param null         $value
     * @param bool         $force
     *
     * @return void
     */
    function setDefaultRequest(string|array $name, mixed $value = null, bool $force = true): void
    {
        try {
            $request = app('request');

            if (is_array($name)) {
                $data = $name;
            } else {
                $data = [$name => $value];
            }

            if ($force) {
                $request->merge($data);
            } else {
                $request->mergeIfMissing($data);
            }
            $request->session()->flashInput($data);
        } catch (Exception $e) {
            // throw $e;
        }
    }
}

if (!function_exists('cachedAsset')) {
    /**
     * @param string $path
     * @param bool|null $secure
     *
     * @return string
     */
    function cachedAsset(string $path, bool|null $secure = null): string
    {
        $asset = str($path)->is('/^https?:\/\//i')
            ? $path
            : asset($path, $secure);

        return $asset . '?v=' . config('cache.version', time());
    }
}

if (! function_exists('activeUser')) {
    /**
     * @param string $message
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function activeUser(string $message = 'Process successful'): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        $user = null;
        if (auth()->check()){
            $user = auth()->user();
        }

        return $user;
    }
}

if (! function_exists('handleException')) {
    /**
     * @param Throwable $throw
     * @return void
     */
    function handleException(Throwable $throw): void
    {
        sendIndicator('Oops! Something Wrong', $throw->getMessage(), true)->duration(5000)->error();
    }
}

if (! function_exists('successToast')) {
    /**
     * @param string $message
     * @return void
     */
    function successToast(string $message = 'Process successful'): void
    {
        sendIndicator('Yea-yy!', $message, true)->duration(5000);
    }
}

