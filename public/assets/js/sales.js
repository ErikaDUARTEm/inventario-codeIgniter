document.addEventListener('DOMContentLoaded', ()=>{
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