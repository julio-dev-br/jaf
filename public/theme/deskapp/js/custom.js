
// Configurações de mensagens toastr
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

// Máscaras para input
var mask = {

    /**
    * Init
    *
    * @param o
    * @param f
    */
    init: function(o, f) {
        v_obj = o;
        v_fun = f;

        setTimeout("mask.execmasc()", 1);
    },

    /**
    * ExecMasc
    */
    execmasc: function() {
        v_obj.value = v_fun(v_obj.value)
    },

    /**
    * Cep
    *
    * @param v
    */
    cep: function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/^(\d{5})(\d)/, "$1-$2");

        return v;
    },

    /**
    * Tel
    *
    * @param v
    */
    tel: function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
        v = v.replace(/(\d)(\d{4})$/, "$1-$2");

        return v;
    },

    /**
    * CPF
    *
    * @param v
    */
    cpf: function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/(\d{3})(\d)/, "$1.$2");
        v = v.replace(/(\d{3})(\d)/, "$1.$2");
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        return v;
    },

    /**
    * CNPJ
    *
    * @param v
    */
    cnpj: function(v) {
        v = v.replace(/\D/g,"");
        v = v.replace(/^(\d{2})(\d)/,"$1.$2");
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3");
        v = v.replace(/\.(\d{3})(\d)/,".$1/$2");
        v = v.replace(/(\d{4})(\d)/,"$1-$2");

        return v
    },

    /**
    * Num
    *
    * @param v
    */
    num: function(v) {
        v = v.replace(/\D/g, "");

        return v;
    },

    /**
    * Date
    *
    * @param v
    */
    date: function(v) {
        v = v.replace(/\D/g,"");
        v = v.replace(/(\d{2})(\d)/,"$1/$2");
        v = v.replace(/(\d{2})(\d)/,"$1/$2");

        v = v.replace(/(\d{2})(\d{2})$/,"$1$2");

        return v;
    },     

}

// Localizar endereço pelo CEP 
function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('street').value=("");
    document.getElementById('neighborhood').value=("");
    document.getElementById('city').value=("");
    document.getElementById('uf').value=("");
    // document.getElementById('ibge').value=("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('street').value=(conteudo.logradouro);
        document.getElementById('neighborhood').value=(conteudo.bairro);
        document.getElementById('city').value=(conteudo.localidade);
        document.getElementById('uf').value=(conteudo.uf);
        // document.getElementById('ibge').value=(conteudo.ibge);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        toastr.error('Cep não localizado, por favor verifique e tente novamente.');
    }
}
        
function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('street').value="...";
            document.getElementById('neighborhood').value="...";
            document.getElementById('city').value="...";
            document.getElementById('uf').value="...";
            // document.getElementById('ibge').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            toastr.error('Cep informado está com formato inválido, por favor verifique e tente novamente.');
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};

