$((function(){"use strict";$('[data-toggle="popover"]').popover(),$('[data-popover-color="head-primary"]').popover({template:'<div class="popover popover-head-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}),$('[data-popover-color="head-secondary"]').popover({template:'<div class="popover popover-head-secondary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}),$('[data-popover-color="primary"]').popover({template:'<div class="popover popover-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}),$('[data-popover-color="secondary"]').popover({template:'<div class="popover popover-secondary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}),$(document).on("click",(function(o){$('[data-toggle="popover"],[data-original-title]').each((function(){$(this).is(o.target)||0!==$(this).has(o.target).length||0!==$(".popover").has(o.target).length||((($(this).popover("hide").data("bs.popover")||{}).inState||{}).click=!1)}))}))}));
