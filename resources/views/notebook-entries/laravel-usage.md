## Laravel Usage

Typically, the first thing I'll do is go and define a few routes within a default HomeController. First, create the new controller using artisan in terminal (laravel 5.3 doesn't have the same defaults as previous versions):

```
php artisan make:controller HomeController
```

This will give you a bare controller. Add your first method within the controller file you just created (within app/http/controllers).

```
public function showHome(){
	$data['title'] = "Home";
	return view('home',$data);
}
```

With this, you are defining a title to pass into your template, and telling Laravel to return the 'home' view. You will now want to add a new route so we go to the right controller method. Add this line within (routes/web.php)

```
Route::get('/','HomeController@showHome');
```