const animItems = document.querySelectorAll('._anim');
if (animItems.length > 0) {
  window.addEventListener('scroll', animOnScroll)
  function animOnScroll(params){
    for (let index = 0; index < animItems.length; index++){
      const animItem = animItems[index];
      // получаем высоту объекта
      const animItemHeight = animItem.offsetHeight;
      // позиция объекта относительно верха
      const animItemOffset = offset(animItem).top;
      //Коэф-нт начала старта анимации
      const animStart = 4;
      
      let animItemPoint = window.innerHeight - animItemHeight / animStart;
      if(animItemHeight > window.innerHeight ){
      animItemPoint = window.innerHeight - window.innerHeight / animStart;
      }
      if((pageYOffset > animItemOffset - animItemPoint) && pageYOffset < (animItemOffset + animItemHeight)){
        animItem.classList.add('_activ');
      }
      //позволяет анимировать повторно
      else{
        animItem.classList.remove('_activ');
      }
    }
  } 
  function offset(el) {
    let rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
  }
  animOnScroll();
};
$(document).ready(function(){
	$('.slider').slick({
		arrows:false,
		dots:true,
		slidesToShow:3,
		slidesToScroll:1,
    infinit:false,
		autoplay:false,
		responsive:[
			{
				breakpoint: 768,
				settings: {
					slidesToShow:2
				}
			},
			{
				breakpoint: 550,
				settings: {
					slidesToShow:1
				}
			}
		]
	});
});
// Отправка заявки 
$(document).ready(function() {
	$('#form').submit(function() { // проверка на пустоту заполненных полей. Атрибут html5 — required не подходит (не поддерживается Safari)
		if (document.form.name.value == '' || document.form.phone.value == '' ) {
			valid = false;
			return valid;
		}
		$.ajax({
			type: "POST",
			url: "telegram.php",
			data: $(this).serialize()
		}).done(function() {
			$('.js-overlay-thank-you').fadeIn();
			$(this).find('input').val('');
			$('#form').trigger('reset');
		});
		return false;
	});
});

