class Jewelry {
    baseConf = {
        canvasId: '',
        baseImgUrl: '',
        height: 690,
        width: 690,
        textInstances: new Map()
    };

    constructor(conf) {
        this.colors = {
            jan:["#4d0875", "0.011618", "-0.235405", "0.713477", "-1.59"],
            feb:["#4d0875", "-0.0981", "-0.0471", "0.474296", "-0.086"],
            mar:["#006291", "-0.000145", "0.101801", "-0.000145", "0"],
            apr:["#4d0875", "-0.01975", "0.011618", "-1", "-0.524"],
            may:["#4d0875", "-0.086407", "-0.160906", "0.180221", "-0.85"],
            jun:["#4d0875", "-0.133459", "0.172379", "-0.039355", "-1.604"],
            jul:["#4d0875", "-0.204037", "-0.243247", "0.99971", "-1.654"],
            aug:["#4d0875", "-0.192274", "-0.015829", "-0.05896", "-1.148"],
            sep:["#4d0875", "-0.243247", "-0.231484", "0.368429", "-0.322"],
            oct:["#4d0875", "-0.078565", "-0.05896", "0.733082", "0.198"],
            nov:["#4d0875", "-0.141301", "0.062591", "0.733082", "0.662"],
            dec:["#4d0875", "-0.035434", "-0.086407", "0.611531", "1.646"]
        };
        this.config = {}
        Object.assign(this.config, this.baseConf, conf);
        this.canvas = new fabric.Canvas(this.config.canvasId);
        this.canvas.setHeight(this.config.height);
        this.canvas.setWidth(this.config.width);
        this.canvas.selection = false;
        this.init();
    }
    getColor(colorName) {
        return this.colors[colorName];
    }
    setColor(fabricImage, colorName) {
        const colorConfig = this.getColor(colorName);
        fabricImage.filters = [];
        const blendColorFilter = new fabric.Image.filters.BlendColor({
            color: colorConfig[0],
            mode: "add",
            alpha: 1
        });
        const contrastFilter = new fabric.Image.filters.Contrast({ //对比度
            contrast: colorConfig[1]
        });
        const brightnessFilter = new fabric.Image.filters.Brightness({ //亮度
            brightness: colorConfig[2]
        });
        const saturationFilter = new fabric.Image.filters.Saturation({ //饱和度
            saturation: colorConfig[3]
        });
        const hueRotationFilter = new fabric.Image.filters.HueRotation({ //色调
            rotation: colorConfig[4]
        });
        fabricImage.filters.push(blendColorFilter);
        fabricImage.filters.push(contrastFilter);
        fabricImage.filters.push(brightnessFilter);
        fabricImage.filters.push(saturationFilter);
        fabricImage.filters.push(hueRotationFilter);
        fabricImage.applyFilters();
        this.canvas.renderAll();
    }
    draw(imgUrl, colorName, id) {
        new fabric.Image.fromURL(imgUrl, (img) => {
            img.scaleToHeight(this.config.height);
            img.scaleToWidth(this.config.width);
            img.set({ left: 0, top: 0 ,hasControls: false, hasBorders: false, selectable: false});
            if (id) {
                img.set({id});
            }
            if (colorName) {
                this.setColor(img, colorName);
            }
            this.canvas.add(img);
        },{
            crossOrigin: "Anonymous",
        });
    }
    _setCoverImg() {
        const objs = this.canvas.getObjects();
        objs.map(item => {
            if (item.id && item.id.includes('cover')) {
                this.canvas.bringToFront(item);
            }
        })
    }
    updataBaseImg(url){
        if (this.canvas.item(0)) {
             const tmp = this.canvas.item(0).getElement();
            tmp.setAttribute("src", url);
            tmp.setAttribute("crossOrigin", 'Anonymous');
            tmp.onload = () => {
                this.canvas.renderAll();
            }
        }
    }
    updataStoneImg(index, colorName) {
        const objs = this.canvas.getObjects();
        objs.map(item => {
            if (item.id && item.id.includes(`Stone${index}`)) {
                this.setColor(item, colorName);
            }
        })
    }
    newText(value, opts) {
        let config = {
            hasControls: false,
            hasBorders: false,
            selectable: false,
            fill: '#484848',
            textAlign: 'center',
            shadow: 'rgba(0,0,0,1) -1px -1px 1px',
            width: 200,
            left: 300,
            top: 300,
            originX: 'center',
            originY: 'center'
        }
        Object.assign(config, opts);
        config.startAngle = config.angle || 0;
        console.log(config);
        const {id, diameter} = config;
        if (!this.config.textInstances.get(id)) {
            const fTextBox = diameter ? new fabric.TextCurved(value, config) : new fabric.Textbox(value, config);
            this.config.textInstances.set(config.id, fTextBox);
            this.canvas.add(fTextBox);
            
        } else {
            this.config.textInstances.get(id).set({
                text: value,
                ...config
            });
        }
        this.canvas.renderAll();
        this._setCoverImg();
    }

    init() {
        this.draw(this.config.baseImgUrl);
    }
}
