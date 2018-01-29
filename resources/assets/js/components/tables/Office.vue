<template>
    <div class="col-sm-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title"> Popis <span class="text-bold"> poslovnica </span></h4>
                <br>

                <button v-show="showButton" type="button" class="btn bg-orange-700" data-toggle="modal"
                        data-target="#modal_default">
                    Dodaj blagajnu
                </button>
            </div>
            <div class="panel-body">
                <table id="offices-table" class="table datatable-html dataTable no-footer">
                    <thead>
                    <tr>
                        <th>Ime poslovnice</th>
                        <th>Adresa</th>
                        <th>Grad</th>
                        <th>Status</th>
                        <th>Opcije</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="office in offices">
                        <td>{{ office.office_name }}</td>
                        <td>{{ office.street }} {{ office.house_number }}</td>
                        <td>{{ office.city }}</td>

                        <td v-if="office.start_date < currentDate && office.is_valid">Otovrena</td>
                        <td v-else-if="office.start_date > currentDate && office.is_valid">{{ moment(office.start_date)}}</td>
                        <td v-else>Zatvorena</td>

                        <td  v-if="office.is_valid">
                            <div style="width: 160px" class="visible-md visible-lg hidden-sm hidden-xs clearfix">

                                <a data-placement="top"
                                   :href="'/offices/edit/' + office.id"
                                   class="btn border-grey text-grey btn-flat btn-icon buttons-fix"
                                   data-popup="popover" title="" data-trigger="hover"
                                   data-original-title="Uredi poslovnicu"

                                >
                                    <i class="icon-database-edit2"></i>
                                </a>

                                <a
                                   data-placement="top"
                                   :href="'offices/newUser/' + office.id"
                                   class="btn border-success text-success btn-flat btn-icon buttons-fix"
                                   data-popup="popover" title="" data-trigger="hover"
                                   data-original-title="Novi operater"
                                >
                                    <i class=" icon-user-plus"></i>
                                </a>

                                <a
                                      href="#"
                                      data-placement="top"
                                      class="btn border-danger text-danger btn-flat btn-icon buttons-fix"
                                      data-popup="popover" title="" data-trigger="hover"
                                      data-original-title="Zatvori poslovnicu"
                                      @click.prevent="close(office.id)"
                                >
                                        <i class="icon-office"></i>
                                    </a>

                                <span
                                        data-placement="top"
                                        data-popup="popover"
                                        data-trigger="hover"
                                        data-content="Postavi zadanu poslovnicu"
                                        style="cursor:pointer"
                                        :class="{'btn border-success text-success' : office.active , 'btn border-grey text-grey' : !office.active }"
                                        @click="setDefault(office.id)"

                                >
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                </span>

                            </div>
                        </td>
                        <td v-else>
                            <span style="color: red;"><b>Poslovnica je zatvorena</b></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="modal_default" class="modal fade" style="wdisplay: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title">Dodaj novu blagajnu</h5>
                    </div>

                    <div class="modal-body">
                        <form role="form" id="add_office_device" method="post"
                              :action="'/offices/addExchangeDeviceToOffice'">

                            <input type="hidden" name="_token" :value="token">

                            <multiselect
                            v-model="selected"
                            :options="options"
                            :searchable="true"
                            select-label=""
                            placeholder="Odaberite poslovnicu"
                            :custom-label="customLabel"
                            @input="getNextExchDeviceNumber()"
                            >
                            </multiselect>

                            <br>

                            <input type="hidden"
                                   name="selected_office"
                                   :value="selected.id"
                            >

                            <div class="form-group">
                                <label>Broj blagajne</label>
                                <input
                                       name="exchange_device_number"
                                       type="text"
                                       class="form-control"
                                       :value="exchangeDevice"
                                       readonly
                                >
                            </div>


                            <div class="form-group" v-if="exchangeDevice">
                                <label>Početni broj računa</label>
                                <input
                                        name="invoice_number_start"
                                        type="text"
                                        class="form-control"
                                        :value="1"

                                >
                            </div>


                            <div class="checkbox" v-if="hasVat">
                                <label class="text-semibold">
                                    <input type="checkbox" class="control-primary" id="sales_device"
                                           name="sales_device">
                                    Veleprodajna blagajna
                                </label>
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Dodaj</button>
                                <button type="button" class="btn bg-orange" data-dismiss="modal">Zatvori</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import bootbox from 'bootbox';
    import Multiselect from 'vue-multiselect';
    import moment from 'moment';
    export default {
        components: {Multiselect},
        data(){
            return {
                //Token
                token: $('meta[name="csrf-token"]').attr('content'),
                showButton: addDevice,
                offices: offices,
                user: user,
                hasVat: hasVat,

                //select2
                options: [],
                selected: '',
                exchangeDevice: '',

                currentDate: currentDate

            }
        },
        methods: {
            moment: function (date) {
                return moment(date).format('DD.MM.YYYY');
            },
            bootbox({message, label, callback}) {
                bootbox.confirm({
                    message,
                    buttons: {
                        confirm: {
                            label,
                            className: 'btn-primary'
                        },
                        cancel: {
                            label: 'Poništi',
                            className: 'bg-orange'
                        }
                    },
                    callback
                });
            },
            close(id) {
                this.bootbox({
                    message: "Jeste li sigurni da želite zatvoriti poslovnicu?",
                    label: 'Zatvori poslovnicu',
                    callback(result){
                        if (result) window.location = '/offices/delete/' + id
                    }
                });
            },
            open(id) {
                this.bootbox({
                    message: "Jeste li sigurni da želite otvoriti poslovnicu?",
                    label: 'Otvori poslovnicu',
                    callback(result){
                        if (result) window.location = '/offices/open/' + id
                    }
                });
            },
            setActive(officeId) {
                this.user.office_id = officeId;

                _.each(offices, function (office) {
                    office.active = false;
                    if (office.id == this.user.office_id) office.active = true;

                }.bind(this));
            },
            setDefault(id) {
                axios.post('/ajax/set_admin_office', {'id': id}).then(this.setActive.call(this,id));
            },
            customLabel (option) {
                return option.name
            },
            getNextExchDeviceNumber(){
                axios.post('/ajax/office_id', {'id': this.selected.id}).then(
                    response => this.exchangeDevice = response.data
                );
            }
        },
        mounted: function () {
            _.each(offices, function (office) {
                if(office.is_valid)
                this.options.push({'id' : office.id, 'name' : office.office_name});

                office.active = false;
                if (office.id == user.office_id) office.active = true;
            }.bind(this));
        }
    }
</script>
