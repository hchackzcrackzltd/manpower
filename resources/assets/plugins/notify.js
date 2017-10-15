function alertnotify(icons,data,type) {
    $.notify({
      icon:icons,
      message:data
    },{
      type:type,
      allow_dismiss: true,
      newest_on_top: true,
      placement: {
        from: "top",
        align: "right"
      },
      delay: 5000,
      timer: 1000,
      animate: {
          enter: 'animated bounceInDown',
          exit: 'animated bounceOutRight'
        },
        offset: {x:20,y:60}
    });
}
