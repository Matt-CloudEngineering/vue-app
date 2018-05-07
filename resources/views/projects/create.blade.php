<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css" type="text/css" rel="stylesheet">

        <!-- Styles -->
        <style>
           
        </style>
    </head>
    <body>
    	<div id="app" class="container" style="margin-top: 1rem;">
    		@include ('projects.list')

    		<form method="POST" action="/projects" @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)">
    			<div class="control">
    				<label for="name" class="label">Project Name:</label>

    				<input class="input" type="text" id="name" v-model="name">

    				<span class="help is-danger" v-text="errors.get('name')"></span>
    			</div>
    			<div class="control">
    				<label for="description" class="label">Project Description:</label>

    				<input type="text" id="description" name="description" class="input" v-model="description">

    				<span class="help is-danger" v-text="errors.get('description')"></span>
    			</div>

    			<div class="control">
    				<button class="button is-primary">Create</button>
    			</div>
    		</form>    		
    	</div>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/vue@2.1.6/dist/vue.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>  
    </body>
</html>
