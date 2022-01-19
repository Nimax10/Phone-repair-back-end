let app_admin = new Vue({
	el: '#app_admin',
	data: {
		orders: [],
		questions: [],
		phones: [],
		company: [],
		models: [],
	},
	created() {
		fetch('/api/AdminDataOrders', {
			method: "GET",
			headers: {
				"Content-Type": "application/json"
			},
			credentials: "same-origin"
		})
		.then(response => response.json())
		.then(data => {
			// console.log(data) 
			this.orders = data
		})
		.catch(err => console.error(err))

		fetch('/api/AdminDataQuest', {
			method: "GET",
			headers: {
				"Content-Type": "application/json"
			},
			credentials: "same-origin"
		})
		.then(response => response.json())
		.then(data => {
			// console.log(data) 
			this.questions = data
		})
		.catch(err => console.error(err))

		fetch('/api/ModelsData', {
			method: "GET",
			headers: {
				"Content-Type": "application/json"
			},
			credentials: "same-origin"
		})
		.then(response => response.json())
		.then(data => {
			// console.log(data) 
			this.phones = data
		})
		.catch(err => console.error(err))

		fetch('/api/AdminDataCompany', {
			method: "GET",
			headers: {
				"Content-Type": "application/json"
			},
			credentials: "same-origin"
		})
		.then(response => response.json())
		.then(data => {
			// console.log(data) 
			this.company = data
		})
		.catch(err => console.error(err))

		fetch('/api/AdminDataModels', {
			method: "GET",
			headers: {
				"Content-Type": "application/json"
			},
			credentials: "same-origin"
		})
		.then(response => response.json())
		.then(data => {
			// console.log(data) 
			this.models = data
		})
		.catch(err => console.error(err))
	},
})