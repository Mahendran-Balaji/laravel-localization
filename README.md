# laravel-localization
Develop multi-language web page using Laravel Application

Laravel 10.20 Localization

5 languages : English, French, Spanish, Arabic and Japanese

Step 1 : Create laravel Application:

```bash
composer create-project laravel/laravel laravel_localization
```

Step 2: Create language Folder and Files (resources/lang/)

For English (en): resource/lang/en/messages.php

```bash
<?php
return [
    'welcome_message' => 'welcome to the developer world'
];
```

For France (fr): resource/lang/fr/messages.php

```bash
<?php
return [
    'welcome_message' => 'bienvenue dans le monde des développeurs'
];
```

For France (sp): resource/lang/sp/messages.php

```bash
<?php
return [
    'welcome_message' => 'Bienvenido al mundo del desarrollador',
];
```

For Arabic (ar): resource/lang/ar/messages.php

```bash
<?php
return [
    'welcome_message' => 'مرحبا بكم في عالم المطورين',
];
```

For Japanese (ja): resource/lang/ja/messages.php

```bash
<?php
return [
    'welcome_message' => '開発者の世界へようこそ'
];
```

Step 3: Create Controller

```bash
php artisan make:controller HomeController
```

Step 4: Add Following Code in the HomeController

```bash
    /**
     * Display the homepage
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        return view('welcome');
    }

    /**
     * Set the requested language
     *
     * @return \Illuminate\Http\Response
    */
    public function changeLang(Request $request){
        if($request->lang){
            App::setLocale($request->lang);
            session()->put('locale', $request->lang);
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
```

Step 5: Create Route:

```bash
use App\Http\Controllers\HomeController;
```

```bash
Route::get('/', [HomeController::class, 'index']);
Route::get('/change', [HomeController::class, 'changeLang'])->name('changeLang');
```

Step 6: Customize view page (welcome.blade.php)

```bash
        <div class="row">
            <div class="col-md-2 col-md-offset-6 text-right">
                <strong>Select Language: </strong>
            </div>
            <div class="col-md-4">
                <select class="form-control changeLanguage">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>
                    <option value="sp" {{ session()->get('locale') == 'sp' ? 'selected' : '' }}>Spanish</option>
                    <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
                    <option value="ja" {{ session()->get('locale') == 'ja' ? 'selected' : '' }}>Japanese</option>
                </select>
            </div>
        </div>
       <h1>{{ __('messages.welcome_message') }}</h1>
       <script>
            var url = "{{ route('changeLanguage') }}";
            $(".changeLanguage").change(function(){
              window.location.href = url + "?lang="+ $(this).val();
            });
        </script>
```

Step 7: Create MiddleWare

```bash
php artisan make:middleware LanguageManager
```

Step 8: Add Following Code

```bash
use App;
```

```bash
 public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
          
        return $next($request);
    }
```

Step 9: we need to register it to kernel file (app/Http/Kernel.php)

```bash
 protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\LanguageManager::class,
        ]
 ],
```

Step 10: Clear the application cache

```bash
php artisan optimize:clear
```

Step 11: Run the application

```bash
php artisan serve
```

Step 12: Run the URL

```bash
http://127.0.0.1:8000/
```
