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

class Form {
	constructor(data) {
		this.data = data;

		for (let field in data) {
			this[field] = data[field];
		}
	}

	reset() {

	}
}
new Vue ({
	el: '#app',

	data: {
		form: new Form({
			name: '',
			description: ''
		}),

		errors: new Errors()
	},

	methods: {
		onSubmit() {
			axios.post('/projects', this.$data)
				.then(this.onSuccess)
				.catch(error => this.errors.record(error.response.data));
		},

	onSuccess(response) {
		alert(response.data.message);

		form.reset();
		}
	}
});
