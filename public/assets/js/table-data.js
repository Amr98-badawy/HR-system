$((function(e){(a=$("#example").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"],responsive:!0,language:{searchPlaceholder:"Search...",sSearch:"",lengthMenu:"_MENU_ "}})).buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)"),$("#example1").DataTable({language:{searchPlaceholder:"Search...",sSearch:"",lengthMenu:"_MENU_"}}),$("#example2").DataTable({responsive:!0,language:{searchPlaceholder:"Search...",sSearch:"",lengthMenu:"_MENU_"}});var a=$("#example-delete").DataTable({responsive:!0,language:{searchPlaceholder:"Search...",sSearch:"",lengthMenu:"_MENU_"}});$("#example-delete tbody").on("click","tr",(function(){$(this).hasClass("selected")?$(this).removeClass("selected"):(a.$("tr.selected").removeClass("selected"),$(this).addClass("selected"))})),$("#button").click((function(){a.row(".selected").remove().draw(!1)})),$("#example-1").DataTable({responsive:!0,language:{searchPlaceholder:"Search...",sSearch:"",lengthMenu:"_MENU_"},responsive:{details:{display:$.fn.dataTable.Responsive.display.modal({header:function(e){var a=e.data();return"Details for "+a[0]+" "+a[1]}}),renderer:$.fn.dataTable.Responsive.renderer.tableAll({tableClass:"table border mb-0"})}}})}));
