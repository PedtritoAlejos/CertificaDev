/*valida si la clave coinciden*/
function validarclave(x3) {
    var x1;
    var x2;
    x2 = x3.value;
    x1 = document.form1.clave1.value;
    if (x2 !== x1) {

        x3.setCustomValidity("Las contraseñas no coinciden");
        return false;

    } else if (x2 === x1) {

        x3.setCustomValidity("");
        return true;
    }
}

/*valida el run ingresado*/
function Valida_Rut(Objeto)

{

    var tmpstr = "";

    var intlargo = Objeto.value;

    if (intlargo.length > 0)

    {

        crut = Objeto.value;

        largo = crut.length;

        if (largo < 2)

        {

            sweetAlert("ERROR", "RUN INVALIDO!", "error");

            //Objeto.focus();

            return false;

        }

        for (i = 0; i < crut.length; i++)
            if (crut.charAt(i) !== ' ' && crut.charAt(i) !== '.' && crut.charAt(i) !== '-')

            {

                tmpstr = tmpstr + crut.charAt(i);

            }

        rut = tmpstr;

        crut = tmpstr;

        largo = crut.length;



        if (largo > 2)
            rut = crut.substring(0, largo - 1);

        else
            rut = crut.charAt(0);



        dv = crut.charAt(largo - 1);



        if (rut === null || dv === null)
            return 0;



        var dvr = '0';

        suma = 0;

        mul = 2;



        for (i = rut.length - 1; i >= 0; i--)

        {

            suma = suma + rut.charAt(i) * mul;

            if (mul === 7) {

                mul = 2;

            } else {

                mul++;
            }

        }



        res = suma % 11;

        if (res === 1) {
            dvr = 'k';

        } else if (res === 0) {
            dvr = '0';

        } else {

            {

                dvi = 11 - res;

                dvr = dvi + "";

            }
        }



        if (dvr !== dv.toLowerCase())

        {


            sweetAlert("ERROR!!!", "RUN INCORRECTO!", "error");
        }
        //Objeto.focus();

        return false;

    }



    //  Objeto.focus();

    return true;

}
/*permite solo numeros en los campos*/

function zisNumber(e) {
    k = (document.all) ? e.keyCode : e.which;
    if (k === 8 || k === 0)
        return true;
    patron = /\d/;
    n = String.fromCharCode(k);
    return patron.test(n);
}

/*permite solo letras en los campos */
function val(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false;
    for (var i in especiales) {
        if (key === especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) === -1 && !tecla_especial) {
        return false;
    }
}

/*le da formato a las fechas*/
function IsNumeric(valor)
{
    var log = valor.length;
    var sw = "S";
    for (x = 0; x < log; x++)
    {
        v1 = valor.substr(x, 1);
        v2 = parseInt(v1);
        //Compruebo si es un valor numérico 
        if (isNaN(v2)) {
            sw = "N";
        }
    }
    if (sw === "S") {
        return true;
    } else {
        return false;
    }
}
var primerslap = false;
var segundoslap = false;
function formateafecha(fecha)
{
    var long = fecha.length;
    var dia;
    var mes;
    var ano;
    if ((long >= 2) && (primerslap === false)) {
        dia = fecha.substr(0, 2);
        if ((IsNumeric(dia) === true) && (dia <= 31) && (dia !== "00")) {
            fecha = fecha.substr(0, 2) + "/" + fecha.substr(3, 7);
            primerslap = true;
        }
        else {
            fecha = "";
            primerslap = false;
        }
    }
    else
    {
        dia = fecha.substr(0, 1);
        if (IsNumeric(dia) === false)
        {
            fecha = "";
        }
        if ((long <= 2) && (primerslap === true)) {
            fecha = fecha.substr(0, 1);
            primerslap = false;
        }
    }
    if ((long >= 5) && (segundoslap === false))
    {
        mes = fecha.substr(3, 2);
        if ((IsNumeric(mes) === true) && (mes <= 12) && (mes !== "00")) {
            fecha = fecha.substr(0, 5) + "/" + fecha.substr(6, 4);
            segundoslap = true;
        }
        else {
            fecha = fecha.substr(0, 3);
            ;
            segundoslap = false;
        }
    }
    else {
        if ((long <= 5) && (segundoslap === true)) {
            fecha = fecha.substr(0, 4);
            segundoslap = false;
        }
    }
    if (long >= 7)
    {
        ano = fecha.substr(6, 4);
        if (IsNumeric(ano) === false) {
            fecha = fecha.substr(0, 6);
        }
        else {
            if (long === 10) {
                if ((ano === 0) || (ano < 1900) || (ano > 2100)) {
                    fecha = fecha.substr(0, 6);
                }
            }
        }
    }
    if (long >= 10)
    {
        fecha = fecha.substr(0, 10);
        dia = fecha.substr(0, 2);
        mes = fecha.substr(3, 2);
        ano = fecha.substr(6, 4);
        // Año no viciesto y es febrero y el dia es mayor a 28 
        if ((ano % 4 !== 0) && (mes === 02) && (dia > 28)) {
            fecha = fecha.substr(0, 2) + "/";
        }
    }
    return (fecha);
}

/*comparar fechas y valida que la fecha final no sea mayor a la de inicio*/



function compararFechas()
{
    var f1 = document.getElementById("fecha1").value;
    var f2 = document.getElementById("fecha2").value;

    var df1 = f1.substring(0, 2);
    var df11 = parseInt(df1);
    var mf1 = f1.substring(3, 5);
    var mf11 = parseInt(mf1);
    var af1 = f1.substring(6, 10);
    var af11 = parseInt(af1);

    var fe111 = new Date(af11, mf11, df11);

    var df2 = f2.substring(0, 2);
    var df22 = parseInt(df2);
    var mf2 = f2.substring(3, 5);
    var mf22 = parseInt(mf2);
    var af2 = f2.substring(6, 10);
    var af22 = parseInt(af2);



    var fe222 = new Date(af22, mf22, df22);


   /* if (fe111 > fe222) {
        sweetAlert("ERROR!!!", "la primera fecha es mayor!", "error");

    } else
    {
        sweetAlert("ERROR!!!", "La segunda fecha es mayor ctm", "error");

    }*/
    alert("fecha "+fe222);

}
         
