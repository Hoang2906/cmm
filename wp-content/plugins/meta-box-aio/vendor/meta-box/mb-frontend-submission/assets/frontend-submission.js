(()=>{var c=jQuery,l=mbFrontendForm;window.ajaxurl||(window.ajaxurl=l.ajaxUrl);var d=l.ajax==="true",f=t=>t.append('<div class="rwmb-loading"></div>'),m=()=>c(".rwmb-loading").remove(),j=t=>c("html, body").animate({scrollTop:t.offset().top-50},200),g=t=>setTimeout(()=>window.location.href=t,2e3),$=({success:t,error:o})=>{grecaptcha.ready(()=>grecaptcha.execute(l.recaptchaKey,{action:"mbfs"}).then(t).catch(o))};function B(){var t=c(this).attr("id");c(document).on("tinymce-editor-init",(o,r)=>{r.on("input keyup",()=>r.save())})}c(function(){c(".rwmb-wysiwyg").each(B)});var i=jQuery,s=mbFrontendForm;function L(){var t=i(this),o=t.find('button[name="rwmb_submit"]'),r=t.find('button[name="rwmb_delete"]'),k=o.attr("data-edit"),T=t.find(".rwmb-validation"),u=0;let p=e=>t.find('input[name="action"]').val(`mbfs_${e}`),_=()=>(i("#rwmb-validation-message").remove(),!i.validator||t.valid());function b(){o.prop("disabled",!0),r.prop("disabled",!0)}function v(){o.prop("disabled",!1),r.prop("disabled",!1)}function h(){d?(f(o),w()):t[0].submit()}function C(){let e=!1;return T.each(function(){let a=i(this).data("validation");Object.values(a.rules).find(n=>n.remote)&&(e=!0)}),e}function D(){return new Promise((e,a)=>{i(document).ajaxComplete(function(n,R,A){let x=i(A.context);(!x.hasClass("mbfs-form")||x.find(".rwmb-error").length===0)&&e(),window.stop(),v(),d&&m(),a("Remote validation error")})})}async function E(e){try{if(u++,(s.recaptchaKey||d)&&e.preventDefault(),!_())return;u==1&&C()&&await D(),b(),p("submit"),s.recaptchaKey?$({success:a=>{t.find('input[name="mbfs_recaptcha_token"]').val(a),h()},error:()=>y(s.captchaExecuteError,!1)}):h()}catch(a){console.log(a)}}function w(e){i(".rwmb-confirmation").remove();let a=new FormData(t[0]);a.append("_ajax_nonce",s.nonce),i.ajax({dataType:"json",type:"POST",data:a,url:s.ajaxUrl,contentType:!1,processData:!1}).done(function(n){m(),v(),y(n.data.message,n.success),j(i(".rwmb-confirmation")),n.success&&n.data.redirect&&g(n.data.redirect),typeof e=="function"&&e(n)})}function y(e,a=!0){a||(e=`<div class="rwmb-confirmation rwmb-error">${e}</div>`),k==="true"||!a?t.prepend(e):t.replaceWith(e)}function F(e){if(!confirm(s.confirm_delete)){e.preventDefault();return}if(b(),p("delete"),!d){t[0].submit();return}let a=i(e.target).closest(".mbfs-actions").parent();e.preventDefault(),f(r),w(n=>{a.length||returnn,a.closest("table").before(`<div class="rwmb-confirmation">${n.data.message}</div>`),a.remove()})}o.on("click",E),r.on("click",F)}i(function(){i(".rwmb-form").each(L)});})();
