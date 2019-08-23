<?php 

Route::resource('series', 'SeriesController');
// 2- make route to lessons     url: 1/lessons
Route::resource('{series_by_id}/lessons', 'LessonsController');