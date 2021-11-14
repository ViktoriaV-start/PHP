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

/* open_img.twig */
class __TwigTemplate_33b4674fc093dcda5487848b1364002642ec20f4817565681cb7a59deedb07f5 extends Template
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
        $this->loadTemplate("nav.twig", "open_img.twig", 14)->display($context);
        // line 15
        echo "
<section class=\"container\">
   <div><a href=\"?action=home\"><button class=\"btn\">HOME</button></a></div>

   <img src= \"images/img_small/";
        // line 19
        echo twig_escape_filter($this->env, ($context["img_name"] ?? null), "html", null, true);
        echo "\" alt=\"Mango\">

</section>

";
        // line 23
        $this->loadTemplate("footer.twig", "open_img.twig", 23)->display($context);
        // line 24
        echo "</body>
</html>";
    }

    public function getTemplateName()
    {
        return "open_img.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 24,  67 => 23,  60 => 19,  54 => 15,  52 => 14,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "open_img.twig", "/Applications/MAMP/htdocs/twig/templates/open_img.twig");
    }
}
