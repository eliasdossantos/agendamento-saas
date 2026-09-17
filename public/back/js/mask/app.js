$(function () {
  $(".money").mask("#,##0.00", { reverse: true });
  $(".cep").mask("00000-000");
  $(".numero_nis").mask("00000000000");
  $(".ibge").mask("0000000");
  $(".codigo_unidade").mask("00000000000");
  $(".cpf").mask("000.000.000-00", { reverse: true });
  $(".cnpj").mask("00.000.000/0000-00", { reverse: true });
  $(".pis").mask("000.00000.00-0", { reverse: true });

  // ─────────────────────────────────────────────
  // Telefone / Celular
  // Aceita:
  // (99) 1234-5678
  // (99) 12345-6789
  // ─────────────────────────────────────────────
  // Telefone / Celular
  var phoneMaskBehavior = function (val) {
    return val.replace(/\D/g, "").length === 11
      ? "(00) 00000-0000"
      : "(00) 0000-00009";
  };

  var phoneMaskOptions = {
    onKeyPress: function (val, e, field, options) {
      field.mask(phoneMaskBehavior.apply({}, arguments), options);
    },
  };

  $(".phone_with_ddd, .sp_celphones").mask(phoneMaskBehavior, phoneMaskOptions);

  $(".uf").mask("AA");
  $(".state").mask("AAA");
  $(".bloco").mask("AAA");
  $(".country").mask("AAA");
  $(".selectonfocus").mask("00000000", { selectOnFocus: true });
  $(".card_number").mask("0000000000000000");
  $(".card_month").mask("00");
  $(".card_year").mask("0000");
  $(".card_cvv").mask("0000");

  $(".plate_mx").mask("AAAAAAA");

  /* ─────────────────────────────────────────────
     Máscara de placa Mercosul
  ───────────────────────────────────────────── */

  $(document).ready(function () {
    maskMercosul(".placa");
  });

  function maskMercosul(selector) {
    var MercoSulMaskBehavior = function (val) {
        var myMask = "AAA0A00";
        var mercosul = /([A-Za-z]{3}[0-9]{1}[A-Za-z]{1})/;
        var normal = /([A-Za-z]{3}[0-9]{2})/;
        var replaced = val.replace(/[^\w]/g, "");

        if (normal.exec(replaced)) {
          myMask = "AAA-0000";
        } else if (mercosul.exec(replaced)) {
          myMask = "AAA-0A00";
        }

        return myMask;
      },
      mercoSulOptions = {
        onKeyPress: function (val, e, field, options) {
          field.mask(MercoSulMaskBehavior.apply({}, arguments), options);
        },
      };

    $(function () {
      $(selector).bind("paste", function () {
        $(this).unmask();
      });

      $(selector).bind("input", function () {
        $(selector).mask(MercoSulMaskBehavior, mercoSulOptions);
      });
    });
  }
});
