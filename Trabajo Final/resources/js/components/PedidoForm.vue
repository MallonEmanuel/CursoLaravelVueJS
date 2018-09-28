<template>
	<div>
		<div class="alert alert-success" v-if="saved">
			<strong>Success!</strong> Your pedido has been saved successfully.
		</div>

		<div class="well well-sm" id="pedido-form">
			<form class="form-horizontal" method="post" @submit.prevent="onSubmit">
				<div class="form-group">
					<label>Fecha Solicitud</label>
					<input type="date" v-model="pedido.fecha_solicitud" class="form-control input-sm" required>
					<!-- <input-date v-model="pedido.fecha_solicitud"></input-date> -->
				</div>
				<div class="form-group">
					<label>Fecha Entrega</label>
					<input type="date" v-model="pedido.fecha_entrega" class="form-control input-sm" required>
				</div>

				<div class="form-group">
					<label>Persona</label>
					<vue-bootstrap-typeahead v-model="query"  :serializer="s => s.nombre+' '+ s.apellido"	:data="personas"/>
  			</div>

				<div class="form-group">
					<label>Vianda</label>
					<input type="text" v-model="pedido.vianda.nombre" class="form-control input-sm" placeholder="" required>
				</div>

				<button type="submit" class="btn btn-primary">Guardar</button>
			</form>
		</div>
	</div>
</template>

<script>

// import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'

export default {

	// extends: VueBootstrapTypeahead,

	data() {
		return {
			errors: [],
			saved: false,

			query:'',

			personas: [],
			endpointPersonas: 'api/personas?page=',
			pageCountPersonas: 1,

			viandas: [],
			endpointViandas: 'api/viandas?page=',
			pageCountViandas: 1,

			pedido: {
				fecha_solicitud: new Date(),
				fecha_entrega: null,
				persona: {id:0,nombre:null},
				vianda: {id:0,nombre:null}
			}
		};
	},

	created() {
			// this.fetch();
			console.log(this.pedido.fecha_solicitud);
			this.fetch();
			this.fetchV();
	},

	methods: {
		fetch(page = 1) {
				axios.get(this.endpointPersonas + page)
				.then(({data}) => {
						this.personas = data.data;
						// this.pageCountPersonas = data.meta.last_page;
						console.log(data.data);
				});
		},

		fetchV(page = 1){
			axios.get(this.endpointViandas + page)
			.then(({data}) => {
					this.viandas = data.data;
					// this.pageCountViandas = data.meta.last_page;
			});
		},

		onSubmit() {
			this.saved = false;
			axios.post('api/pedidos', this.pedido)
			.then(({data}) => this.setSuccessMessage())
			.catch(({response}) => this.setErrors(response));
		},

		setErrors(response) {
			this.errors = response.data.errors;
		},

		setSuccessMessage() {
			this.reset();
			this.saved = true;
		},

		reset() {
			this.errors = [];
			this.pedido = {
											fecha_solicitud: null,
											fecha_entrega: null,
											persona: {id:0,nombre:null},
											vianda: {id:0,nombre:null}
			};

		}
	}
}
</script>
