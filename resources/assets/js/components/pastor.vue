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
                        <h5>LISTADO DE PASTORES REGISTRADOS</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                             <div class="card-header">
                                <i class="fa fa-align-justify"></i> Clientes
                                <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-secondary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                                </button>
                             </div>
                     <!-- buscar datos -->
                     <div class="form-group row">
                            <div class="col-sm-3 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="num_documento">DNI</option>
                                      <option value="email">email</option>                          
                                </select>
                                </div>

                            <div class="col-sm-3">
                            <div class="input-group">
                            <input placeholder="Search" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="input-sm form-control" type="text">
                             <span class="input-group-btn">
                            <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Buscar!</button>
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
                        <th>Nombres</th>
                        <th>T.Doc</th>
                        <th>Número</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Avatar</th>
                        <th>Email</th>
                        <th>Conyugue</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="persona in arrayPersona" :key="persona.id" class="gradeX">
                         <td v-text="persona.nombre">
                            <div v-text="persona.apellidos"></div>
                           
                         </td>
                         <td v-text="persona.tipo_documento"></td>
                         <td v-text="persona.num_documento"></td>
                         <td v-text="persona.direccion"></td>
                         <td v-text="persona.telefono"></td>
                         <td v-text="persona.avatar"></td>
                         <td v-text="persona.email"></td>
                         <td v-text="persona.nombre_conyugue"></td>
                        <td>
                            <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm">
                                 <i class="fa fa-edit"></i>
                            </button> &nbsp;

                        </td>
                    </tr>
                  
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombres</th>
                        <th>T.Doc</th>
                        <th>Número</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Avatar</th> 
                        <th>Email</th>
                        <th>Conyugue</th>
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
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Apellidos</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="apellidos" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo Documento</label>
                                    <div class="col-md-9">
                                        <select v-model="tipo_documento" class="input-sm form-control input-s-sm inline">
                                            <option value="DNI">DNI</option>
                                            <option value="RUC">RUC</option>
                                            <option value="PASS">PASS</option>
                                        </select>                                    
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Numero de Doc</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="num_documento" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                                <div v-show="errorPersona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="direccion" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Celular</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="telefono" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Conyugue</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre_conyugue" class="form-control" placeholder="Nombre de Conyugue">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Celular Conyugue</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="telefono_conyugue" class="form-control" placeholder="Celular de Conyugue">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
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
        data (){
            return {
                persona_id: 0,
                nombre : '',
                apellidos: '',
                tipo_documento : 'DNI',
                num_documento : '',
                direccion : '',
                telefono : '',
                avatar : '',
                email : '',
                nombre_conyugue: '',
                telefono_conyugue: '',
                arrayPersona : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
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
            listarPersona (page,buscar,criterio){
                let me=this;
                var url= './pastor?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {

                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas.data;
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
                me.listarPersona(page,buscar,criterio);
            },
            registrarPersona(){
                if (this.validarPersona()){
                    return;
                }
                
                let me = this;

                axios.post('./pastor/registrar',{
                    'nombre': this.nombre,
                    'apellidos': this.apellidos,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'nombre_conyugue' :this.nombre_conyugue,
                    'telefono_conyugue' : this.telefono_conyugue

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarPersona(){
               if (this.validarPersona()){
                    return;
                }
                
                let me = this;

                axios.put('./pastor/actualizar',{
                    'nombre': this.nombre,
                    'apellidos': this.apellidos,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,                    
                    'nombre_conyugue' :this.nombre_conyugue,
                    'telefono_conyugue' : this.telefono_conyugue,
                    'id': this.persona_id

                }).then(function (response) {
                     console.log(response);
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },            
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                if (!this.nombre) this.errorMostrarMsjPersona.push("El nombre de la persona no puede estar vacío.");

                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.apellidos='';
                this.tipo_documento='DNI';
                this.num_documento='';
                this.direccion='';
                this.telefono='';
                this.avatar='';
                this.email='';
                this.nombre_conyugue='';
                this.telefono_conyugue='';
                this.errorPersona=0;

            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Pastor';
                                this.nombre= '';
                                this.apellidos= '';
                                this.tipo_documento='RUC';
                                this.num_documento='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.nombre_conyugue='';
                                this.telefono_conyugue='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Pastor';
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                this.nombre = data['nombre'];
                                this.apellidos = data['apellidos'];
                                this.tipo_documento = data['tipo_documento'];
                                this.num_documento = data['num_documento'];
                                this.direccion = data['direccion'];
                                this.telefono = data['telefono'];
                                this.email = data['email'];
                                this.nombre_conyugue = data['nombre_conyugue'];
                                this.telefono_conyugue = data['telefono_conyugue'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
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
        color: red !important;
        font-weight: bold;
    }
</style>
