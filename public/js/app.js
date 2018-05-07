class Errors {
	constructor() {
		this.errors = {};
	}

	get(field) {
		if (this.errors[field]) {
			return this.errors[field][0];
		}
	}

	clear(field) {
		delete this.errors[field];
	}

	record(errors) {
		this.errors = errors;
	}

	has(field) {
		 return this.errors.hasOwnProperty(field);
	}

	any() {
		return Object.keys(this.errors).length > 0;
	}
}

new Vue ({
	el: '#app',

	data: {
		name: '',
		description: '',
		errors: new Errors()
	},

	methods: {
		onSubmit() {
			axios.post('/projects', this.$data)
				.then(response => alert('Success'))
				.catch(error => this.errors.record(error.response.data.errors));
		}
	}
});
