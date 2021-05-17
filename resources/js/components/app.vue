<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Items in database:</div>

                    <div class="card-body">
                        <div>
                            <add-item-form />
                        </div>
                        <list-view />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import addItemForm from "./addItemForm";
    import listView from "./listView"
    export default {
        components: {
            addItemForm,
            listView
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
