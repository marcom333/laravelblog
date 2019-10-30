@component('mail::message')

Congratulations on creating the new Project with the title of '{{$project->title}}'

To see your project go to: 

@component('mail::button', ['url' => url('/projects/' . $project->id)])
Here :v
@endcomponent

Thanks my lord,<br>
{{ config('app.name') }}
@endcomponent
