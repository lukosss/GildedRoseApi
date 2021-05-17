<template>
    <div class="addItem" @submit.prevent="addItem">
        <h2>Add Item</h2>
        <b-form>
            <b-form-group label="Item Category:" label-for="input-1">
                <b-form-input required v-model="item.category" id="input-1" type="text"/>
            </b-form-group>
            <b-form-group label="Item Name:" label-for="input-2">
                <b-form-input required v-model="item.name" id="input-2" type="text"/>
            </b-form-group>
            <b-form-group label="Item Value:" label-for="input-3">
                <b-form-input required v-model="item.value" id="input-3" type="text"/>
            </b-form-group>
            <b-form-group label="Item Quality:" label-for="input-4">
                <b-form-input required v-model="item.quality" id="input-4" type="text"/>
            </b-form-group>
            <b-button :variant="item.category || item.name || item.value || item.quality ? 'success' : 'outline-success'" type="submit">Add Item</b-button>
        </b-form>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            item: {
                category: "",
                name: "",
                value: "",
                quality: ""
            }
        }
    },
    methods: {
        addItem() {
            if(this.item.name == '' || this.item.value == '' || this.item.category == '' || this.item.quality == '') {
                return;
            }

            axios.post('api/item/store', {
                item: this.item
            })
            .then( response => {
                if( response.status == 201 ) {
                    this.item.category = "";
                    this.item.name = "";
                    this.item.value = "";
                    this.item.quality = "";
                }
            })
            .catch( error => {
                console.log( error );
            })
        }
    }
}
</script>
