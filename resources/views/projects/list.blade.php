<ul>
	<h4>Projects:</h4>
	@foreach ($projects as $project)
	<li> {{ $project->name }} </li>
	@endforeach
	<hr>
	
</ul>