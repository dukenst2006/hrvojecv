<template>
    <div class="col-lg-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title"> Tablica <span class="text-bold"> predložaka </span></h4>
            </div>
            <div class="panel-body">
                <table id="templates-table" class="table-responsive-fix table datatable-html dataTable no-footer">
                    <thead>
                    <tr>
                        <th>Tip</th>
                        <th>Naslov</th>
                        <th>Datum uređivanja</th>
                        <th>Opcije</th>
                    </tr>
                    </thead>
                    <tbody v-for="template in templates">
                    <tr>
                        <td v-if="template.template_type == 'racun'">
                            Račun
                        </td>
                        <td v-else-if="template.template_type == 'ponuda'">
                            Ponuda
                        </td>
                        <td v-else>
                            Opomena
                        </td>

                        <td>
                            {{ template.title }}
                        </td>
                        <td>
                            {{ template.updated_at }}
                        </td>
                        <td>
                            <div class="clearfix">
                                <a
                                        data-placement="top"
                                        :href="z'/templates/edit/' + template.id"
                                        class="btn border-grey text-grey btn-flat btn-icon buttons-fix"
                                        data-popup="popover" title="" data-trigger="hover"
                                        data-original-title="Uredi predložak"
                                >
                                    <i class=" icon-database-edit2"></i>
                                </a>

                                <a
                                        href="#"
                                        data-placement="top"
                                        class="btn border-danger text-danger btn-flat btn-icon buttons-fix"
                                        data-popup="popover"
                                        data-trigger="hover"
                                        data-original-title="Obriši predložak"
                                        @click.prevent="remove(template.id)"
                                >
                                    <i class="icon-database-remove"></i>
                                </a>
                                <span
                                        data-placement="top"
                                        data-popup="popover"
                                        data-trigger="hover"
                                        data-content="Postavite zadani predložak koji će se koristiti za slanje mail-a"
                                        data-original-title="Postavi predložak"
                                        :class="{'btn border-success text-success' : template.active , 'btn border-grey text-grey' : !template.active }"
                                        @click="setDefault(template.id, template.template_type)"
                                >
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                </span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import bootbox from 'bootbox';
    export default {
        data(){
            return {
                templates: templates
            }
        },
        methods: {
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
            remove(id){
                this.bootbox({
                    message: "Jeste li sigurni da želite obrisati predložak?",
                    label: 'Obriši predložak',
                    callback(result){
                        window.location = '/templates/delete/' + id

                    }
                });
            },
            setActive(id, type) {
                _.each(templates, function (template) {
                    if( template.template_type == type) template.active = false;
                    if(template.id == id) template.active = true;

                }.bind(this));

            },
            setDefault(id, type){
                axios.post('/ajax/change_default_template', {'id': id, 'type' : type}).then(this.setActive.call(this,id, type));
            }
        },
        mounted: function () {
            _.each(templates, function (template) {
                template.active = false;
                if(template.default_template) template.active = true;
            })
        }
    }
</script>