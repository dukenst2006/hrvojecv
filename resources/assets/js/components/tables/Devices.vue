<template>
    <div class="col-sm-6 pull-right">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title"> Popis <span class="text-bold"> blagajni </span></h4>
                <br>
            </div>

            <div class="panel-body">
                <table id="exchange_device_table" class="table datatable-html dataTable no-footer">
                    <thead>
                    <tr>
                        <th>Šifra blagajne</th>
                        <th>Opcije</th>
                        <th>Stanje blagajne</th>
                    </tr>
                    </thead>
                    <tbody v-for="exchDev in exchangeDevices">

                    <tr>
                        <td v-if="exchDev.sales_device">
                            {{ exchDev.device_number }} - Veleprodajna blagajna
                        </td>
                        <td v-else>
                            {{ exchDev.device_number }} - Maloprodajna blagajna
                        </td>
                        <td>
                            <span   v-if="user.office_id == office.id"
                                    style="cursor: pointer"
                                    data-trigger="hover"
                                    data-placement="top"
                                    data-content="Postavi zadanu blagajnu"
                                    data-original-title="Zadana blagajna"
                                    :class="{'btn border-success text-success' : exchDev.active , 'btn border-grey text-grey' : !exchDev.active }"
                                    @click="setDefault(exchDev.id)"
                            >
                                <i class="glyphicon glyphicon-ok-sign"></i>
                            </span>

                            <span class="btn border-success text-success"
                                  data-popup="popover"
                                  data-trigger="hover"
                                  data-placement="top"
                                  data-original-title="Stanje blagajne"
                                  @click="changeAmountState(exchDev.id)"
                            >
                                <i class="icon-cash3"></i>
                            </span>
                        </td>
                        <td>

                        <a  v-if="exchDev.log_state.length > 0"
                            :href="'/offices/exchangeDeviceStatePdf/' + exchDev.id"
                            target='_blank'
                            class='btn border-danger text-danger btn-flat btn-icon'
                            data-popup='popover'
                            data-placement="top"
                            data-trigger='hover'
                            data-original-title='Ispiši PDF'
                        >
                            <i class='icon-file-pdf'></i>
                        </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="modal_default2" class="modal fade" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <div class="modal-body">
                        <form role="form" id="exchange_device_state_form" method="post"
                              :action="'/offices/addExchangeDeviceAmountSate'">


                            <input type="hidden" name="exchange_device_id" :value="exchangeDeviceId">
                            <input type="hidden" name="_token" :value="token">

                            <div class="form-group">
                                <label class="col-sm-3 control-label label-fix"><span class="text-danger">* </span>Stanje
                                    blagajne</label>
                                <div class="col-sm-9" id="exchange_device_inputs">
                                    <input id="exchange_device_amount" type="text" class="form-control"
                                           name="exchange_device_amount"/>
                                </div>
                            </div>

                            <div class="modal-footer">

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Unesi</button>
                                <button type="button" class="btn btn bg-orange" data-dismiss="modal">Zatvori</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                token: $('meta[name="csrf-token"]').attr('content'),
                exchangeDevices: exchangeDevice,
                user: user,
                exchangeDeviceId: '',
                office: sel_office
            }
        },
        methods: {
            setActive(deviceId){
                this.user.exchange_device_id = deviceId;

                _.each(exchangeDevice, function (exchDev) {
                    exchDev.active = false;
                    if(exchDev.id == user.exchange_device_id) exchDev.active = true;
                });
            },
            setDefault(id){
                axios.post('/ajax/set_admin_exchange_device', {'id': id}).then(this.setActive.call(this,id));
            },
            changeAmountState(id){
                $('#modal_default2').modal('show');
                this.exchangeDeviceId = id;
            }
        },
        mounted(){
            _.each(exchangeDevice, function (exchDev) {
                exchDev.active = false;
                if(exchDev.id == user.exchange_device_id) exchDev.active = true;
            });
        }
    }
</script>