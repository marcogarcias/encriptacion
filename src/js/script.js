var Encrypt={
  init: function(){
    this.events();
  },
  events: function(){
    var this_ = this;
    $(".btn-crud").on("click", function(){
      var json = JSON.parse($(this).attr('data-action'));
      this_[json.act](json.idx, json.act);
    });
    /*$('.btn-nav').on('click', function(e){
      //e.preventDefault();
      $('#act').val($(this).attr('name'));
      $('#frm-nav').submit();
    });*/
  },
  new: function(){
    console.log('nuevo');
  },
  edit: function(idx, act){
    act = act?act:'new';
    var txt = act=='new'?'':$('#txt-'+idx).text();
    var frm = this.frmModal(txt, act, idx);
    $('.modal-body-cont').html(frm);
  },
  delete: function(idx){
    console.log('eliminar');
  },
  frmModal: function(txt, act, idx){
    return ''+
      '<form method="post" action="">'+
      '  <div class="form-group">'+
      '    <textarea class="form-control" rows="7" name="txt">'+txt+'</textarea>'+
      '  </div>'+
      '  <div class="modal-foot-btns">'+
      '    <input type="hidden" name="act" value="'+act+'">'+
      '    <input type="hidden" name="idx" value="'+idx+'">'+
      '    <button class="btn btn-wh">Aceptar</button>'+
      '    <button class="btn btn-wh" data-dismiss="modal">Cancelar</button>'+
      '  </div>'+
      '</form';
  },
  launchToastr: function(cfg){
    var ty = cfg.ty || "success";
    var msg = cfg.msg;
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-center",
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
    };
    toastr[ty](msg);
  }
}