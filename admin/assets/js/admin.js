$(function(){
  // Sidebar toggle (mobile)
  $('#sidebarToggle').on('click',function(){
    $('#adminSidebar').toggleClass('open');
  });

  // Auto-dismiss alerts
  setTimeout(function(){ $('.auto-dismiss').fadeOut(400,function(){ $(this).remove(); }); }, 4000);

  // Confirm delete
  $(document).on('click','.btn-delete-confirm',function(e){
    if(!confirm('Are you sure you want to delete this item? This action cannot be undone.')) e.preventDefault();
  });

  // Preview image before upload
  $('input[type=file][data-preview]').on('change',function(){
    const preview = $($(this).data('preview'));
    if(this.files && this.files[0]){
      const reader = new FileReader();
      reader.onload = function(e){ preview.attr('src',e.target.result).show(); };
      reader.readAsDataURL(this.files[0]);
    }
  });
});
