$( document ).ready(function() {
    $("form", ".deleteForm").on("submit", function(){
        return confirm("Etes-vous sur ?")
    });
});