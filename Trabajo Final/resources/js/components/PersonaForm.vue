<template>
	<div>
		<div class="alert alert-success" v-if="saved">
			<strong>Success!</strong> Your persona has been saved successfully.
		</div>

		<div class="well well-sm" id="persona-form">
			<form class="form-horizontal" method="post" @submit.prevent="onSubmit">
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" v-model="persona.nombre" class="form-control input-sm" placeholder="Nombre" required>
				</div>
				<div class="form-group">
					<label>Apellido</label>
					<input type="text" v-model="persona.apellido" class="form-control input-sm" placeholder="Apellido" required>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" v-model="persona.email" class="form-control input-sm" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
				</div>
				<button type="submit" class="btn btn-primary">Guardar</button>
				<button  type="button"class="btn btn-success" onclick="window.location.href='/personas'">Cancelar</button>
			</form>
		</div>
	</div>
</template>

<script>
export default {
	props:['persona_id'],
	// mounted() {
	//    // let app = this;
	//    let id = this.$route.params.id;
	//    // app.companyId = id;
	//    axios.get('/api/personas/' + id)
	//      .then(function (resp) { this.persona = resp.data;})
	//      .catch(function () {
	//              alert("Could not load your company")
	//      });
  // },

	data() {
		return {
			errors: [],
			saved: false,
			persona: {
				nombre: null,
				apellido: null,
				email: null
			}
		};
	},
	created() {
			this.fetchPersona();
	},
	methods: {
		onSubmit() {
			this.saved = false;

			if(this.persona.id == null){
				axios.post('../api/personas', this.persona)
				.then(({data}) => this.setSuccessMessage())
				.catch(({response}) => this.setErrors(response));
			}else{
				// Modifica un pedido existente
				axios.put('../api/personas/'+this.persona.id, this.persona)
				.then(({data}) => this.setSuccessMessage())
				.catch(({response}) => this.setErrors(response));
			}
		},

		fetchPersona(){
			if(this.persona_id == null){
				return;
			}
			 axios.get("../api/personas/"+this.persona_id)
			 .then(({data}) => {
					 this.persona= data.data;
					 console.log(this.persona.id);
			 }).catch(({response}) => this.setErrors(response));
		},

		setErrors(response) {
			this.errors = response.data.errors;
		},

		setSuccessMessage() {
			this.reset();
			this.saved = true;
		},

		reset() {
			window.location.href='/personas';
			this.errors = [];
			this.persona = {nombre: null, apellido: null, email: null};
		}
	}
}
</script>
