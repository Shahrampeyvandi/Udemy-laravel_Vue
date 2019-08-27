<?php

namespace Bahdcasts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'episode_number' => 'required',
            'video_id' => 'required'
        ];
    }

      /**
     * Upload the series image passed in the request
     *
     * @return App\Http\Requests\CreateSeriesRequest
     */
    public function uploadLessonVideo()
    {
        $uploadedVideo = $this->video_id;

        $this->fileName = str_slug($this->title) . '.' . $uploadedVideo->getClientOriginalExtension();

        $uploadedVideo->storePubliclyAs(
            'public/series',  $this->fileName
        );

        return $this;
    }

    public function storeLesson() 
    {
        $lesson = Lesson::create([
            'title' => $this->title,
            'description' => $this->description,
            'episode_number'=> $this->episode_number,
            'series_id'=>2,
            'video_id' => 'series/' . $this->fileName
        ]);

        session()->flash('success', 'Series created successfully.');
        return back();
    }
}
