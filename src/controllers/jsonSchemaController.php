<?php
namespace Controllers;
use JsonSchema\Validator;
use JsonSchema\Constraints\Constraint;
use Flight;

class jsonSchemaController {

    function generateForm($schema) {
        $html = '<form method="POST" action="/player/save" class="needs-validation" validate>';
        foreach ($schema as $fieldName => $fieldProps) {
            $required = isset($fieldProps['nullable']) && $fieldProps['nullable'] === false ? 'required' : '';
            $title = $fieldProps['title'] ?? $fieldName;
            $class = 'form-control'; // Clase de Bootstrap por defecto
    
            // Determinar el tipo de input
            $type = $fieldProps['type'];
            if ($type === 'integer' && isset($fieldProps['enum'])) {
                $type = 'select'; // Si es un integer con opciones, es un select
            } elseif ($type === 'boolean') {
                $type = 'checkbox'; // Booleanos son checkboxes
            } elseif ($fieldName === 'join_date') {
                $type = 'date'; // Fechas son inputs de tipo date
            } elseif (isset($fieldProps['enum'])) {
                $type = 'select'; // Si tiene opciones predefinidas, es un select
            } elseif ($type === 'select-multiple') {
                $type = 'select-multiple'; // Si es un select múltiple
            }
    
            // Atributos adicionales
            $maxLength = isset($fieldProps['maxLength']) ? "maxlength='{$fieldProps['maxLength']}'" : '';
            $min = isset($fieldProps['minimum']) ? "min='{$fieldProps['minimum']}'" : '';
            $max = isset($fieldProps['maximum']) ? "max='{$fieldProps['maximum']}'" : '';
            $pattern = isset($fieldProps['pattern']) ? "pattern='{$fieldProps['pattern']}'" : '';
            $placeholder = isset($fieldProps['placeholder']) ? "placeholder='{$fieldProps['placeholder']}'" : '';
            $value = isset($fieldProps['default']) ? "value='{$fieldProps['default']}'" : '';
    
            $html .= '<div class="mb-3">';
            $html .= "<label for='$fieldName' class='form-label'>$title</label>";
    
            // Generar el input según el tipo
            if ($type === 'checkbox') {
                $html .= "<div class='form-check'>";
                $html .= "<input type='checkbox' class='form-check-input' id='$fieldName' name='$fieldName' $required $value>";
                $html .= "<label class='form-check-label' for='$fieldName'>$title</label>";
                $html .= "</div>";
            } elseif ($type === 'select') {
                $html .= "<select class='$class' id='$fieldName' name='$fieldName' $required>";
                foreach ($fieldProps['enum'] as $option) {
                    $selected = ($option === ($fieldProps['default'] ?? '')) ? 'selected' : '';
                    $html .= "<option value='$option' $selected>$option</option>";
                }
                $html .= "</select>";
            } elseif ($type === 'select-multiple') {
                $html .= "<select class='$class' id='$fieldName' name='{$fieldName}[]' $required multiple>";
                foreach ($fieldProps['options'] as $option) {
                    $selected = (is_array($fieldProps['default'] ?? []) && in_array($option, $fieldProps['default'])) ? 'selected' : '';
                    $html .= "<option value='$option' $selected>$option</option>";
                }
                $html .= "</select>";
            } elseif ($type === 'date') {
                $html .= "<input type='date' class='$class' id='$fieldName' name='$fieldName' $required $value>";
            } else {
                $html .= "<input type='$type' class='$class' id='$fieldName' name='$fieldName' $required $maxLength $min $max $pattern $placeholder $value>";
            }
    
            // Mensaje de validación
            $html .= '<div class="invalid-feedback">';
            $html .= "Por favor, proporciona un valor válido para $title.";
            $html .= '</div>';
    
            $html .= '</div>';
        }
        $html .= '<button type="submit" class="btn btn-primary">Enviar</button>';
        $html .= '</form>';
    
        // Script para manejar la validación del formulario
        $html .= "
        <script>
        (function () {
            'use strict'
    
            // Selecciona todos los formularios con la clase .needs-validation
            var forms = document.querySelectorAll('.needs-validation')
    
            // Itera sobre ellos y previene el envío si no son válidos
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
    
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        </script>";
    
        return $html;
    }

    // 3. Función para validar los datos
    function validateFormData($data, $schema) {
        $validator = new Validator();
        $validator->validate($data, $schema, Constraint::CHECK_MODE_TYPE_CAST);

        if ($validator->isValid()) {
            return true;
        } else {
            return $validator->getErrors();
        }
    }
}

