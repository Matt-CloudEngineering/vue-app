<body>
	<div id="app" class="container">
		@include ('projects.list')

		<form method="POST" action="/projects" @submit.prevent="onSubmit">
			<div class="control">
				<label for="name" class="label">Project Name:</label>

				<input class="input" type="text" id="name" v-model="name">

				<span class="help is-danger" v-text="errors.get('name')"></span>
			</div>
			<div class="control">
				<label for="description">Project Description:</label>

				<input type="text" id="description" name="description" class="input" v-model="description">
			</div>

			<div class="control">
				<button class="bitton is-primary">Create</button>
			</div>
		</form>
		
	</div>
</body>