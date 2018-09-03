<template>
               <main class="main">
            <!-- Breadcrumb -->
                 <!-- cabezera deonde va el titulo -->
                
               <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Datos Vacamel</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Tables</a>
                        </li>
                        <li class="active">
                            <strong>Data Tables</strong>
                        </li>
                    </ol>
                </div>

            </div>
            <!-- ventana -->
         <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>LISTADO DE FUNDOS REGISTRADOS</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                             <div class="card-header">
                                <i class="fa fa-align-justify"></i> Categorías
                                <button type="button" @click="abrirModal('fundos','registrar')" class="btn btn-secondary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                                </button>
                             </div>
                     <!-- buscar datos -->
                     <div class="form-group row">
                            <div class="col-sm-3 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" v-model="criterio">
                                      <option value="fund_nombre">Nombre</option>
                                      <option value="fund_departamento">Descripción</option>
                                </select>
                                </div>

                            <div class="col-sm-3">
                            <div class="input-group">
                            <input placeholder="Search" v-model="buscar" @keyup.enter="listarFundos(1,buscar,criterio)" class="input-sm form-control" type="text">
                             <span class="input-group-btn">
                            <button type="submit" @click="listarFundos(1,buscar,criterio)" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Buscar!</button>
                             </span>
                            </div>
                                
                            </div>
                        </div>
                        
                        </div>
                    </div>

                
                            
                    <div class="ibox-content">




                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Nombre de Fundo</th>
                        <th>Departamento</th>
                        <th>Provincia</th>
                        <th>Lugar</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de estado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="fundos in arrayFundos" :key="fundos.fund_id" class="gradeX">
                        <td v-text="fundos.fund_nombre"></td>
                        <td v-text="fundos.fund_departamento"></td>
                        <td v-text="fundos.fund_provincia"></td>
                        <td v-text="fundos.fund_lugar"></td>
                        <td v-text="fundos.created_at"></td>
                        <td>
                                        <div v-if="fundos.fund_condicion">
                                            <span class="badge badge-info">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                        </td>
                        <td>
                            <button type="button" @click="abrirModal('fundos','actualizar',fundos)" class="btn btn-warning btn-sm">
                                 <i class="fa fa-edit"></i>
                            </button> &nbsp;

                             <template v-if="fundos.fund_condicion">
                                 <button type="button" class="btn btn-danger btn-sm" @click="desactivarFundo(fundos.fund_id)">
                                     <i class="fa fa-minus-circle"></i>
                                 </button>
                              </template>
                              <template v-else>
                                  <button type="button" class="btn btn-info btn-sm" @click="activarFundo(fundos.fund_id)">
                                    <i class="fa fa-check-circle-o"></i>
                                  </button>
                              </template>
                        </td>
                    </tr>
                  
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre de Fundo</th>
                        <th>Departamento</th>
                        <th>Provincia</th>
                        <th>Lugar</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de estado</th>
                        <th>Opciones</th>
                    </tr>
                    </tfoot>
                    </table>
                    <nav>
                             <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                        </div>

                    </div>
                </div>
            </div>
        
        </div>
        </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="fund_nombre" class="form-control" placeholder="Nombre de categoría">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="fund_departamento" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                                                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="fund_provincia" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                                                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="fund_lugar" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                                <div v-show="errorFundo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjFundo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarFundo()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarFundo()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </main>

  

</template>

<script>

    export default {
    	data	() {
    		return {
                fund_id: 0,
    			fund_nombre : '',
    			fund_departamento :'',
                fund_provincia :'',
                fund_lugar :'',
                arrayFundos : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorFundo : 0,
                errorMostrarMsjFundo : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'fund_nombre',
                buscar : ''
    		}

    	},
              computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },

    	methods : {

           listarFundos(page,buscar,criterio){
                let me=this;
                var url= './fundos?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    console.log(response);
                    var respuesta = response.data;
                    me.arrayFundos = respuesta.fundo.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
              },
           cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarFundos(page,buscar,criterio);
            },
         registrarFundo(){

                if (this.validarFundo()){
                    return;
                }
                
                let me = this;

                axios.post('./fundos/registrar',{
                    'fund_nombre': this.fund_nombre,
                    'fund_departamento': this.fund_departamento,
                    'fund_provincia': this.fund_provincia,
                    'fund_lugar': this.fund_lugar
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarFundos(1,'','fund_nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
              actualizarFundo(){
               if (this.validarFundo()){
                    return;
                }
                
                let me = this;

                axios.put('./fundos/actualizar',{
                    'fund_nombre': this.fund_nombre,
                    'fund_departamento': this.fund_departamento,
                    'fund_provincia': this.fund_provincia,
                    'fund_lugar': this.fund_lugar,
                    'fund_id': this.fund_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarFundos(1,'','fund_nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarFundo(fund_id){
               swal({
                title: 'Esta seguro de desactivar este Fundo?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('./fundos/desactivar',{
                        'fund_id': fund_id
                    }).then(function (response) {
                        me.listarFundos(1,'','fund_nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarFundo(fund_id){
               swal({
                title: 'Esta seguro de activar esta categoría?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('./fundos/activar',{
                        'fund_id': fund_id
                    }).then(function (response) {
                        me.listarFundos(1,'','fund_nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarFundo(){
                this.errorFundo=0;
                this.errorMostrarMsjFundo =[];

                if (!this.fund_nombre) this.errorMostrarMsjFundo.push("El nombre del no puede estar vacío.");

                if (this.errorMostrarMsjFundo.length) this.errorFundo = 1;

                return this.errorFundo;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.fund_nombre='';
                this.fund_departamento='';
            },
             abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "fundos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Categoría';
                                this.fund_nombre= '';
                                this.fund_departamento = '';
                                this.fund_provincia= '';
                                this.fund_lugar = '';
                                this.tipoAccion = 1;
                         
                            
                                break;
                            }
                            case 'actualizar':
                            {
                                console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar fundo';
                                this.tipoAccion=2;
                                this.fund_id=data['fund_id'];
                                this.fund_nombre = data['fund_nombre'];
                                this.fund_departamento = data['fund_departamento'];
                                this.fund_provincia = data['fund_provincia'];
                                this.fund_lugar = data['fund_lugar'];
                             
                                break;
                            }
                        }
                    }
                }
            }
            },
   
       
        mounted() {
            this.listarFundos(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: grey !important;
        font-weight: bold;
    }
</style>