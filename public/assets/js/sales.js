document.addEventListener('DOMContentLoaded', ()=>{
    //buscador de clientes
    $('#selectCustomer').select2({
        ajax: {
            url: '/inventario/public/search/client',
            dataType: 'json',
            data:function(params){
                return {
                    searchTerm: params.term
                }
            },
            processResults: function(data){
                return{
                    results: $.map(data, function(item){
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                }
            }
          }
    });
    //buscador de productos
    $('#selectProduct').select2({
        ajax: {
            url: '/inventario/public/search/product',
            dataType: 'json',
            data:function(params){
                return {
                    searchTerm: params.term
                }
            },
            processResults: function(data){
                return{
                    results: $.map(data, function(item){
                        return {
                            text: item.title,
                            id: item.code
                        }
                    })
                }
            }
          }
    });
})

function selectCustomer(){
    const selectCustomer = document.querySelector("#selectCustomer");
    const id =  selectCustomer.options[selectCustomer.selectedIndex].value;
    document.querySelector("#customer_id").value = id;
   
}