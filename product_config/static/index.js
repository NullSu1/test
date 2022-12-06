$(function () {  
  let instance = null;
  function initFieldsHtml() {  
    let html = '';
    for (let i = 1; i < 6; i++) {
      html += `
      <div class="field${i} field-item" data-index="${i}">
        <h4>文字${i}</h4>
        <div class="box"> 
          <div class="field">
            <label for="field${i}">field:</label>
            <input id="field${i}" type="text" name="field${i}"><i></i>
          </div>
          <div class="opt">
            <label for="flipped${i}">文字是否反转:</label>
            <input id="flipped${i}" type="checkbox" name="flipped${i}">
          </div>
          <div class="opt">
            <label for="kerning${i}">文字字母间距:</label>
            <input id="kerning${i}" type="number" name="kerning${i}" value="0" >
          </div>
          <div class="opt">
            <label for="diameter${i}">文字弧度:</label>
            <input id="diameter${i}" type="range" step="50" min="0" max="1000" name="diameter${i}" value="0" >
          </div>
          <div class="opt">
            <label for="angle${i}">文字角度:</label>
            <input id="angle${i}" type="range" step="0.3" min="-90" max="90" name="angle${i}" value="0" >
          </div>
          <div class="opt">
            <label for="fontSize${i}">文字大小:</label>
            <input id="fontSize${i}" type="number" name="fontSize${i}" value="30" >
          </div>
        </div>
      </div>
      <hr>
      `;
    }
    $('.fields').append(html);
  }
  function getConfig(el) {  
    const $parent = $(el).parents('.field-item');
    const index = $parent.data('index');
    const id = `drawText${index}`;
    const fontFamily = $('#fontFamily').val();
    const fill = $('#color').val();
    const field = $parent.find('input[name*="field"]').val();
    const flipped = $parent.find('input[name*="flipped"]').is(':checked') ? true : false;
    const kerning = $parent.find('input[name*="kerning"]').val() * 1;
    const diameter = $parent.find('input[name*="diameter"]').val() * 1;
    const fontSize = $parent.find('input[name*="fontSize"]').val() * 1;
    const angle = $parent.find('input[name*="angle"]').val() * 1;
    return {id, fill, field, flipped, kerning, diameter, fontFamily, fontSize, angle}
  }

  function renderText(config) {  
    let timer = null;
    
    const {field, id} = config;
    if (!field) {
      return;
    }
    clearTimeout(timer);
    const oldCfgAll = instance.config.textInstances.get(id);
    const left = oldCfgAll?.left || 350;
    const top = oldCfgAll?.top || 350;
    const angle = oldCfgAll?.angle || 0;
    const diameter = oldCfgAll?.diameter || 0;
    const width = oldCfgAll?.width || 200;
    timer = setTimeout( () => {  
      const option = { 
        hasControls: true,
        hasBorders: false,
        selectable: true,
        fontSize: 30
      };
      Object.assign(option, {left, top, angle, diameter, width}, config);
      instance.newText(field, option);
    }, 1000);
  }
  document.querySelector('#file').onchange = function (){
    if(this.files.length){
      let file = this.files[0];
      let reader = new FileReader();
      reader.onload = function(){
        instance = new Jewelry({
          canvasId: 'c',
          baseImgUrl: this.result,
          width: 690, 
          height: 690
        });
      };
      reader.readAsDataURL(file);
    }
  }
  
  initFieldsHtml();

  $('.settings input').on('input propertychange', function () {  
    if($(this).attr('type') === 'text') {
      $(this).siblings('i').text($(this).val().length);
    }
    renderText(getConfig(this));
  });
  $('#save').click(function () {
    const map = instance.config.textInstances;
    let result = [];
    const pdtId = $('#pdtId').val().trim();
    const designIndex = $('#designIndex').val();
    if (!window.confirm(`确定提交的是:${designIndex}吗?`)) {
      return false;
    }
    for (var [key, value] of map) {
      let { type, left, top, fill, angle, scaleX, scaleY, fontSize, diameter, kerning, flipped, fontFamily, width, height, field } = value;
      fontFamily = fontFamily.replace(' ', '');
      left = Number.parseFloat(left).toFixed(4) * 1;
      top = Number.parseFloat(top).toFixed(4) * 1;
      scaleX = Number.parseFloat(scaleX).toFixed(4) * 1;
      scaleY = Number.parseFloat(scaleY).toFixed(4) * 1;
      const obj = { type, left, top, fill, angle, scaleX, scaleY, fontSize, diameter, kerning, flipped, width, height, field };
      Object.assign(obj, {textIndex: key + '-' + fontFamily, pdtId, designIndex});
      result.push(obj);
    }
    $.ajax({
      url: 'insert.php', 
      type: 'POST',
      data: {data: result},
      success: function(res) {
	   
        if (res == 'true') {
          alert('添加成功');
        }
      },
      error: function(xhr, status, error) {
        if (error) {
          alert('抱歉，添加失败，请刷新重试');
        }
      }
    })
  });

  $('.fields').on('click', 'h4', function() {
    $(this).next().slideToggle();
  })
});
