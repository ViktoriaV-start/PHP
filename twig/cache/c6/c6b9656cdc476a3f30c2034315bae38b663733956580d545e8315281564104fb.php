<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* index.twig */
class __TwigTemplate_fbcf809a5dd66300f5db5765aae73b03540b200c932f3a294ec6bac3ef184b3b extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>BranD Shop</title>
    <script src=\"https://use.fontawesome.com/95b86417ef.js\"></script>
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\">
    <link href=\"https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400&display=swap\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"/style/norm.css\">
    <link rel=\"stylesheet\" href=\"/style/style.css?ver=<?php echo time();?>\">
</head>

<body>
    ";
        // line 14
        $this->loadTemplate("nav.twig", "index.twig", 14)->display($context);
        // line 15
        echo "
    <section class='promo__content promo_mrg container'>
    ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["images"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 18
            echo "        <a href=\"?name=";
            echo twig_escape_filter($this->env, $context["item"], "html", null, true);
            echo "\"><img src= \"images/img_big/";
            echo twig_escape_filter($this->env, $context["item"], "html", null, true);
            echo "\" alt=\"Mango\"></a>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "
    </section>

    ";
        // line 24
        $this->loadTemplate("footer.twig", "index.twig", 24)->display($context);
        // line 25
        echo "</body>
</html>


";
        // line 36
        echo "
";
        // line 38
        echo "
";
        // line 46
        echo "
";
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 46,  90 => 38,  87 => 36,  81 => 25,  79 => 24,  74 => 21,  62 => 18,  58 => 17,  54 => 15,  52 => 14,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "/Applications/MAMP/htdocs/twig/templates/index.twig");
    }
}
