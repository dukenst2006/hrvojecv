<template>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat table-container-fix">
                <h6 class="panel-title"><span class="text-danger">* </span>Artikli / Usluge</h6>

                <br>

                <multiselect
                        :options="options"
                        v-model="selectedItems"
                        :multiple="true"
                        :hide-selected="true"
                        :select-label="'Pritisnite Enter za odabir'"
                        placeholder="Odaberite proizvod"
                        :custom-label="getItemLabel"
                        @input="calculatePrice()"
                >
                </multiselect>

                <br>
                <br>

                <table class="table-responsive" id="tableID" v-show="selectedItems.length > 0">
                    <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th><label class="control-label">Naziv</label></th>
                        <th><label class="control-label">Opis</label></th>
                        <th><label class="control-label">Cijena bez PDV-a</label></th>
                        <th><label class="control-label">Popust (&#37;)</label></th>
                        <th><label class="control-label">PDV (&#37;)</label></th>
                        <th><label class="control-label">Količina</label></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(selectedItem, count) in selectedItems">
                        <td style="display: none;">
                            <input
                                    type="hidden"
                                    :value="selectedItem.id"
                            >
                        </td>
                        <td>
                            <input
                                    type="text"
                                    :value="selectedItem.item_name"
                                    :name="'objekt[' + count + '][title]'"
                                    readonly
                            >
                        </td>
                        <td>
                            <input
                                    type="text"
                                    :value="selectedItem.description"
                                    :name="'objekt[' + count + '][description]'"
                                    readonly
                            >
                        </td>
                        <td>
                            <input
                                    type="text"
                                    :value="selectedItem.price"
                                    :name="'objekt[' + count + '][price]'"
                                    id='priceitem'
                                    readonly
                            >
                        </td>
                        <td>
                            <input
                                    type="text"
                                    :value="selectedItem.discount"
                                    :name="'objekt[' + count + '][discount]'"
                                    id='priceDiscount'

                            >
                        </td>
                        <td>
                            <input
                                    type="text"
                                    :value="selectedItem.tax"
                                    :name="'objekt[' + count + '][tax]'"
                                    id='priceTax'
                                    @change="calculatePrice()"
                            >
                        </td>
                        <td>
                            <input
                                    type="text"
                                    :name="'objekt[' + count + '][quantity]'"
                                    v-model="quantity"
                                    id='quantityitem'
                                    @change="calculatePrice()"
                            >
                        </td>
                    </tr>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td>
                            <br>
                            <a href="" class="btn bg-teal btn-block btn-table-fix" type="submit">
                                Očisti formu <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <!-- <td></td> -->
                        <td>
                            <br>
                            <button class="btn bg-teal btn-block btn-table-fix" type="submit" id="btnAddVendor">
                                Kreiraj <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        components: {Multiselect},
        data(){
            return {
                //select2
                options: items,
                selectedItems: [],

                //calculations
                priceWithVat: '',
                priceWithoutVat: '',
                quantity: 1,

                pdv: ''
            }
        },
        methods: {
            getItemLabel(option) {
                return option.item_name;
            },
            calculatePrice(){


                if (this.pdv) {
                    this.calculateWithVat();
                } else {
                    this.calculateWithoutVat();
                }
            },
            calculateWithVat(){
                let trs = $("#tableID tbody").children();

                let total_price = 0;
                let total_price_without_vat = 0;

                $.each(trs, function(k,tr) {
                    let price = $(tr).find('#priceitem').val(),
                        qty = $(tr).find('#quantityitem').val();
                    let discount = $(tr).find('#priceDiscount').val();
                    let tax = $(tr).find('#priceTax').val();

                    if(localStorage.getItem('medianRate') > 0){
                        price =  price / localStorage.getItem('medianRate');
                    }

                    let price_discount = 0;
                    let  price_tax = 0;

                    if(discount > 0) {
                        price_discount = price * (discount/100);
                    }
                    if(tax > 0 ) {
                        if(price_discount > 0) {
                            total_price += (price - price_discount) * ((tax/100)+1) * qty;
                        }else {
                            total_price += price * ((tax/100)+1) * qty;
                        }
                    } else {
                        if(price_discount > 0) {
                            total_price += (price - price_discount) * qty;
                        }else {
                            total_price += price * qty;
                        }
                    }
                    total_price_without_vat += (price - price_discount) * qty;
                    $(tr).find('#priceitemshow').val(price);
                });

                $('#totalCost').val(total_price.toFixed(2));
                $('#costWithoutVat').val( total_price_without_vat.toFixed(2));
            },
            calculateWithoutVat(){
                let trs = $("#tableID tbody").children();

                let total_price = 0;
                let total_price_without_vat = 0;

                $.each(trs, function(k,tr) {
                    var price = $(tr).find('#priceitem').val(),
                        qty = $(tr).find('#quantityitem').val();
                    var discount = $(tr).find('#priceDiscount').val();

                    if(localStorage.getItem('medianRate') > 0){
                        price =  price / localStorage.getItem('medianRate');
                    }

                    var price_discount = 0;

                    if(discount > 0) {
                        price_discount = price * (discount/100);
                    }
                    if(price_discount > 0) {
                        total_price += (price - price_discount) * qty;
                    }else {
                        total_price += price * qty;
                    }

                    total_price_without_vat += (price - price_discount) * qty;
                    $(tr).find('#priceitemshow').val(price);
                });

                $('#totalCost').val(total_price.toFixed(2));
                $('#costWithoutVat').val( total_price_without_vat.toFixed(2));
            }
        },
        mounted(){
            Vue.nextTick(function () {
                let check_pdv = $('#vat').prop('checked');
                (check_pdv) ? this.pdv = true : false;
            }.bind(this));
        }
    }
</script>