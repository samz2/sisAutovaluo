<template>
    <div class="content">
	    <div class="container-fluid">
	    	<div class="row">
			 <div class="col-md-12">
	            
				<!-- agregar encargado de facultad -->
				
	            <div class="card card-default">
	                <div class="card-header text-center">
	                    <h4 class="title">Agregar Persona</h4>  
	                </div>
	                <div class="card-body">
	                    <form @submit.prevent="registrar" method="POST">
	                        <div class="row">
	                            <div class="col-md-2">
	                                <div class="form-group">
	                                    <label>DNI/RUC</label>
	                                    <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' 
											v-model="persona.dni" class="form-control"   maxlength="11">
	                                </div>
	                            </div>
								<div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Nombres</label>
	                                    <input type="text" v-model="persona.nombre" class="form-control"  maxlength="30">
	                                </div>
	                            </div>
								<div class="col-md-4">
	                                <div class="form-group">
	                                    <label>Apellidos</label>
	                                    <input type="text" v-model="persona.ape" class="form-control"  maxlength="60">
	                                </div>
	                            </div>
								<div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Celular</label>
	                                    <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' 
										v-model="persona.cel" class="form-control"  maxlength="10">
	                                </div>
	                            </div>
	                        </div>
							<div class="row">
	                            <div class="col-md-6">
	                                <div class="form-group">
	                                    <label>Direccion</label>
	                                    <input type="text" v-model="persona.dir" class="form-control"   maxlength="100">
	                                </div>
	                            </div>
								<div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Tipo</label>
	                                    <select v-model="persona.tipo" id="tipo" @change="click" class="form-control">
											<option value="1" selected>Administrador</option>
											<option value="2">Cobrador</option>
											<option value="3">Usuario</option>
										</select>
	                                </div>
	                            </div>
								<div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Fecha de Nacimiento</label>
	                                    <input type="date" v-model="persona.fecha" class="form-control"  maxlength="60">
	                                </div>
	                            </div>
							</div>
							<div class="row" id="cod">
									<div class="col-md-4">
	                                <div class="form-group" >
	                                    <label>Codigo Contribuyente</label>
	                                    <input type="text"  v-model="persona.codContribuyente" class="form-control"  maxlength="60">
	                                </div>
									</div>
								</div>
							<div class="row text-left">
								<div class="col-md-2">
									<input type="submit" value="Agregar" class="btn btn-success">
								</div>
							</div>
							<div class="clearfix"></div>
	                    </form>
	                </div>
				</div>
			</div>
	    	</div>
	    </div>
	</div>
</template>

<script>
    export default {
    data() {
        return {
            persona: {
				dni:null,
				nombre:null,
				ape:null,
				cel:null,
				dir:null,
				tipo:null,
				codContribuyente:null,
				fecha:null
			}
        }
	},
	mounted()
	{
		$('#cod').hide();
	},
    methods: {
        registrar()
		{
			axios.post("addUser",{
				persona:this.persona
			}).then(data=>{
				console.log(data);
				swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos ingresados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
			}).catch(error=>{
				console.log(error);	
			})
		},
		click()
		{
			console.log(this.persona.tipo);
			if (this.persona.tipo==3) 
			{
			$("#cod").show();
			}
			else {
			$("#cod").hide();

			}
		}
    }
}

</script>


