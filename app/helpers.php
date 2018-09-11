<?php

/**
 * Create a static view.
 *
 * @example
 *
 *     // The following:
 *     Route::get('/my-module', staticView('mymodule'));
 *
 *     // is equivalent to:
 *     Route::get('/my-module', function() {
 *         return view('mymodule');
 *     });
 *
 * @param string $view
 * @return {Function}
 */
function staticView($view)
{
    return function () use ($view) {
        return view($view);
    };
}
