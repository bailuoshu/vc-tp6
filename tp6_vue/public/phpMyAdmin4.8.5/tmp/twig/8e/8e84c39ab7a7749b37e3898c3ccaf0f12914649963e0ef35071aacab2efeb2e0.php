<?php

/* privileges/global_priv_tbl_item.twig */
class __TwigTemplate_16f46d2167e74d11693f7c9853c964ebb0f34e1f31241d8b81e7ecb05e8f56e6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<div class=\"item\">
    <input type=\"checkbox\" class=\"checkall\" name=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute(($context["priv"] ?? null), 0, [], "array"), "html", null, true);
        echo "_priv\" id=\"checkbox_";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["priv"] ?? null), 0, [], "array"), "html", null, true);
        echo "_priv\"
        value=\"Y\" title=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute(($context["priv"] ?? null), 2, [], "array"), "html", null, true);
        echo "\" ";
        echo twig_escape_filter($this->env, ($context["checked"] ?? null), "html", null, true);
        echo " />
    <label for=\"checkbox_";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute(($context["priv"] ?? null), 0, [], "array"), "html", null, true);
        echo "_priv\">
        <code>
            ";
        // line 6
        echo ($context["formatted_priv"] ?? null);
        echo "
        </code>
    </label>
</div>
";
    }

    public function getTemplateName()
    {
        return "privileges/global_priv_tbl_item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 6,  34 => 4,  28 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "privileges/global_priv_tbl_item.twig", "D:\\phpstudy_pro\\WWW\\tp\\public\\phpMyAdmin4.8.5\\templates\\privileges\\global_priv_tbl_item.twig");
    }
}
