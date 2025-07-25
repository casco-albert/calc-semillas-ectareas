<?php 
/*
Plugin Name: Calculador Semillas/Hectárea
Description: Calcula la cantidad de semillas necesarias para sembrar un terreno
Version: 1.0
Author: Alberto Casco
*/
//plugin code goes here

//create a form with the following fiels: Size of property in Hectarias, weight of 1000 seeds in grams, Number of plant in a meter line, space between lines and percentage of germination
function seed_calc_form_elementor_widget(){
  if(class_exists('Elementor\\Widget_base')){
    class Seed_Calc_Widget extends \Elementor\Widget_base {
      public function get_name(){
        return 'seed-calc';
      }
      public function get_title(){
        return __('Seed Calculator', 'seed-calc');
      }
      public function get_icon(){
        return 'fa fa-calculator';
      }
      public function get_categories(){
        return ['general'];
      }
      protected function _register_controls(){
        $this->start_controls_section(
          'content_section',
          [
            'label' => __('Content', 'seed-calc'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
          ]
        );
        //add a section with tittle and text to explain the calculation
        $this->add_control(
          'title1',
          [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Description',
            'placeholder' => 'Description',
          ]
        );
        $this->add_control(
          'description1',
          [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => 'Description',
            'placeholder' => 'Description',
          ]
        );
         $this->add_control(
          'title2',
          [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Resultado',
            'placeholder' => 'Resultado',
          ]
        );
        $this->add_control(
          'description2',
          [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => 'Description',
            'placeholder' => 'Description',
          ]
        );
        $this->end_controls_section();
      }
      protected function render(){
        $settings = $this->get_settings_for_display();
        echo'
          <div id="seed-calc">
  <div id="seed-calc-form" class="show">
    <div class="rows">
      <div class="col-md-6">
        <h2 class="descrip-tittle">' . $settings['title1']. '</h2>
        <div class="descrip">'.$settings['description1'].'</div>
      </div>
      <div class="col-md-6">
        <h2>Calculadora de Siembra de Soja</h2>
        <h4>Cantidad de semillas por hectárea</h4>
        <div class="row">
          <div class="col-md-4">
            <label for="area">1. Tamaño total del área en hectáreas (ha)</label>
            <input type="number" id="area" name="area" value="">
          </div>
          <div class="col-md-4">
            <label for="peso">2. Peso de 1000 semillas en gramos (g)</label>
            <input type="number" id="peso" name="peso" value="">
          </div>
          <div class="col-md-4">
            <label for="nro">3. Número de plantas por metro lineal</label>
            <input type="number" id="nro" name="nro" value="">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label for="esp">4. Espaciamiento entre las líneas (cm)</label>
            <input type="number" id="esp" name="esp" value="">
          </div>
          <div class="col-md-4">
            <label for="porc">5. Porcentaje de emergencia</label>
            <input type="number" id="porc" name="porc" value="">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
            <button id="seed-calc-btn" class="btn btn-primary">Calcular</button>
    </div>
  </div>
  <div id="seed-calc-result" class="hide">
    <div class="rows">
      <div class="col-md-6">
        <h2 class="descrip-tittle">' . $settings['title2'] . '</h2>
        <div class="descrip">'.$settings['description2'].'</div>
      </div>
      <div class="col-md-6">
        <h2>Resultados</h2>
        <div class="row">
          <div class="col-md-4">
            <label for="sxml">1. Cantidad de semillas x metro lineal</label>
            <input type="text" id="sxml" name="sxml" value="" readonly="readonly">
          </div>
          <div class="col-md-4">
            <label for="sdc">2. Cantidad total de las semillas x hectárea</label>
            <input type="text" id="sdc" name="sdc" value="" readonly="readonly">
          </div>
          <div class="col-md-4">
            <label for="pesoTsemi">3. Peso total de semillas x hectárea (Kg)</label>
            <input type="text" id="pesoTsemi" name="pesoTsemi" value="" readonly="readonly">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label for="kxh">4. Cantidad total de semillas del área (ha)</label>
            <input type="text" id="kxh" name="kxh" value="" readonly="readonly">
          </div>
          <div class="col-md-4">
            <label for="sxh">5. Peso total de semillas del área (ha) (Kg)</label>
            <input type="text" id="sxh" name="sxh" value="" readonly="readonly">
          </div>
        </div>
        <div class="col-md-4">
            <button id="return-btn" class="btn btn-primary">Volver</button>
        </div>
      </div>
    </div>
  </div>
</div>
        ';
      }
    }
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Seed_Calc_Widget());
  }
}
add_action('elementor/widgets/widgets_registered', 'seed_calc_form_elementor_widget');

//enqueue the script
function seed_calc_enqueue_scripts(){
  wp_enqueue_script('seed-calc', plugin_dir_url(__FILE__) . 'js/seed-calc.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'seed_calc_enqueue_scripts');
//enqueue the style
function seed_calc_enqueue_styles(){
  wp_enqueue_style('seed-calc', plugin_dir_url(__FILE__) . 'css/seed-calc.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'seed_calc_enqueue_styles');

?>