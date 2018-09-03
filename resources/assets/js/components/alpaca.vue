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
                <div class="col-lg-2">

                </div>
            </div>
            <!-- Fin del modal Eliminar -->
         <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>LISTADO DE ALPACAS REGISTRADAS</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                             <div class="card-header">
                                <i class="fa fa-align-justify"></i> alpacas
                                <button type="button" @click="abrirModal('alpaca','registrar')" class="btn btn-secondary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                                </button>
                             </div>
                       <!-- buscar datos -->
                     <div class="form-group row">
                            <div class="col-sm-3 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" v-model="criterio">
                                      <option value="alpa_nombre">Nombre</option>
                                      <option value="alpa_arete">Arete</option>
                                </select>
                                </div>

                            <div class="col-sm-3">
                            <div class="input-group">
                            <input placeholder="Search" v-model="buscar" @keyup.enter="listarAlpaca(1,buscar,criterio)" class="input-sm form-control" type="text">
                             <span class="input-group-btn">
                            <button type="submit" @click="listarAlpaca(1,buscar,criterio)" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Buscar!</button>
                             </span>
                            </div>
                                
                            </div>
                        </div>
                         <!-- buscar fin -->
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Arete de Alpaca</th>
                        <th>Nombre</th>
                        <th>Fundo</th>
                        <th>Peso de nac</th>
                        <th>Descripcion</th>
                        <th>Fecha de Creacion</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="alpaca in arrayAlpaca" :key="alpaca.alpa_id" class="gradeX">
                        <td v-text="alpaca.alpa_arete"></td>
                        <td v-text="alpaca.alpa_nombre"></td>
                        <td v-text="alpaca.fund_nombre"></td>
                        <td v-text="alpaca.alpa_peso_nac"></td>
                        <td v-text="alpaca.alpa_descripcion"></td>
                        <td v-text="alpaca.created_at"></td>
                      
                        <td>
                                        <div v-if="alpaca.alpa_condicion">
                                            <span class="badge badge-info">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                        </td>
                        <td>
                            <button type="button" @click="abrirModal('alpaca','actualizar',alpaca)" class="btn btn-warning btn-sm">
                                 <i class="fa fa-edit"></i>
                            </button> &nbsp;

                             <template v-if="alpaca.alpa_condicion">
                                 <button type="button" class="btn btn-danger btn-sm" @click="desactivarAlpaca(alpaca.alpa_id)">
                                     <i class="fa fa-minus-circle"></i>
                                 </button>
                              </template>
                              <template v-else>
                                  <button type="button" class="btn btn-info btn-sm" @click="activarAlpaca(alpaca.alpa_id)">
                                    <i class="fa fa-check-circle-o"></i>
                                  </button>
                              </template>
                        </td>
                    </tr>
                  
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Arete de Alpaca</th>
                        <th>Nombre</th>
                        <th>Fundo</th>
                        <th>Peso de nac</th>
                        <th>Descripcion</th>
                        <th>Fecha de Creacion</th>
                        <th>Estado</th>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Fundo</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idfundo">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="fundos in arrayFundos" :key="fundos.fund_id" :value="fundos.fund_id" v-text="fundos.fund_nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>

                                <!-- codigo QRcode -->
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Arete:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="alpa_arete" class="form-control" placeholder="ingrese numero de Arete">

                                        <qrcode-vue :value="alpa_arete"  level = "H" v-if="" >
                                            generando codigo
                                        </qrcode-vue>
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Nombre de Alpaca</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="alpa_nombre" class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Peso de Nacimiento</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="alpa_peso_nac" class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="alpa_descripcion" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                                <div v-show="errorAlpaca" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjAlpaca" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarAlpaca()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAlpaca()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </main>

  

</template>

<script>
import Vue from 'vue';
import QrcodeVue from 'qrcode.vue';
    export default {
    	data	() {
    		return {
                alpa_id: 0,
                idfundo: 0,
    			fund_nombre : '',
                alpa_nombre : '',
    			alpa_arete :'',
                alpa_peso_nac :'',
                alpa_descripcion :'',
                arrayAlpaca : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorAlpaca : 0,
                errorMostrarMsjAlpaca : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'alpa_arete',
                buscar : '',
                arrayFundos : []
    		}

    	},
    components: {
             QrcodeVue

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

           listarAlpaca(page,buscar,criterio){
                let me=this;
                var url= './alpaca?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    console.log(response);
                    var respuesta = response.data;
                    me.arrayAlpaca = respuesta.alpacas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
              },


             selectAlpaca(){
                let me=this;
                var url= './fundos/selectAlpaca';
                axios.get(url).then(function (response) {
                   // console.log(response);
                    var respuesta= response.data;
                    me.arrayFundos = respuesta.fundos;
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
                me.listarAlpaca(page,buscar,criterio);
            },
                registrarAlpaca(){
                if (this.validarAlpaca()){
                    return;
                }
                
            let me = this;

                axios.post('./alpaca/registrar',{
                    'idfundo': this.idfundo,
                    'alpa_arete' : this.alpa_arete,
                    'alpa_nombre': this.alpa_nombre,
                    'alpa_peso_nac': this.alpa_peso_nac,
                    'alpa_descripcion': this.alpa_descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAlpaca(1,'','alpa_nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarAlpaca(){
               if (this.validarAlpaca()){
                    return;
                }
                
                let me = this;

                axios.put('./alpaca/actualizar',{
                    'idfundo': this.idfundo,
                    'alpa_arete' : this.alpa_arete,
                    'alpa_nombre': this.alpa_nombre,
                    'alpa_peso_nac': this.alpa_peso_nac,
                    'alpa_descripcion': this.alpa_descripcion,
                    'alpa_id':  this.alpa_id
                }).then(function (response) {
                     //console.log(response);
                    me.cerrarModal();
                    me.listarAlpaca(1,'','alpa_nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
  
            desactivarAlpaca(alpa_id){
               swal({
                title: 'Esta seguro de desactivar esta alpaca?',
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

                    axios.put('./alpaca/desactivar',{
                        'alpa_id': alpa_id
                    }).then(function (response) {
                        me.listarAlpaca(1,'','alpa_nombre');
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
            activarAlpaca(alpa_id){
               swal({
                title: 'Esta seguro de activar esta alpaca?',
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

                    axios.put('./alpaca/activar',{
                        'alpa_id': alpa_id
                    }).then(function (response) {
                        me.listarAlpaca(1,'','alpa_nombre');
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
            validarAlpaca(){
                this.errorAlpaca=0;
                this.errorMostrarMsjAlpaca =[];

                if (!this.alpa_nombre) this.errorMostrarMsjAlpaca.push("El nombre de la alpaca no puede estar vacío.");
                if (!this.alpa_arete) this.errorMostrarMsjAlpaca.push("El arete de la alpaca no puede estar vacío.");
                if (this.idfundo==0) this.errorMostrarMsjAlpaca.push("Seleccione un fundo.");

                if (this.errorMostrarMsjAlpaca.length) this.errorAlpaca = 1;

                return this.errorAlpaca;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idfundo= 0;
                this.fund_nombre='';
                this.alpa_arete='';
                this.alpa_nombre='';
                this.alpa_peso_nac=0;
                this.alpa_descripcion='';
                this.errorAlpaca =0;

               
            },
             abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "alpaca":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Alpaca';
                                this.idfundo=0;
                                this.fund_nombre= '';
                                this.alpa_arete = '';
                                this.alpa_nombre= '';
                                this.alpa_peso_nac = 0;
                                this.alpa_descripcion = '';
                                this.tipoAccion = 1;
                                                            
                                break;
                            }
                            case 'actualizar':
                            {
                                console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Alpaca';
                                this.tipoAccion=2;
                                this.alpa_id=data['alpa_id'];
                                this.idfundo=data['idfundo'];
                                this.alpa_arete=data['alpa_arete'];
                                this.alpa_nombre = data['alpa_nombre'];
                                this.alpa_peso_nac = data['alpa_peso_nac'];
                                this.alpa_descripcion = data['alpa_descripcion'];
                          
                             
                                break;
                            }
                        }
                    }
                }
                this.selectAlpaca();
            }
            },
   
       
        mounted() {
            this.listarAlpaca(1,this.buscar,this.criterio);
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