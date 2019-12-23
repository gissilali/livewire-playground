<?php


Route::get('/{page?}', function ($view = null) {
    if (is_null($view)) {
        return view('welcome');
    } else {
        return view($view);
    }
})->name('page');
