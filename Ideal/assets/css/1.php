<?php



    $form->addItem(new Iedal('<div class="mdui-panel mdui-panel-popout" mdui-panel>'));
        $form->addItem(new Iedal('<div class="mdui-panel-item">'));
                $form->addItem(new Iedal('<div class="mdui-panel-item-header">文章版权'));
                $form->addItem(new Typecho_Widget_Helper_Layout("/div"));
            $form->addItem(new Iedal('<div class="mdui-panel-item-body">'));

                $author = new Typecho_Widget_Helper_Form_Element_Text('author', NULL, _t('小宇宙'),_t('文章作者'), _t('作者：<a href="https://github.com/Yves-X/Copyright-for-Typecho/" target="_blank">Yves-X</a>；修复人：<a href="https://moe.best/" target="_blank">神代綺凜</a>。'));
                $form->addInput($author);

                $notice = new Typecho_Widget_Helper_Form_Element_Text('notice', NULL, _t('转载时须注明出处及本声明'), _t('文章声明'), _t('文章版权选项;根据自己意愿填写'));
                $form->addInput($notice);

                $showURL = new Typecho_Widget_Helper_Form_Element_Checkbox('showURL', array(1 => _t('是的')), NULL, _t("是否显示文章链接"), _t("文章版权选项"));
                $form->addInput($showURL);

                $showOnPost = new Typecho_Widget_Helper_Form_Element_Checkbox('showOnPost', array(1 => _t('是的')), NULL, _t("是否在文章显示"), _t("文章版权选项"));
                $form->addInput($showOnPost);

                $showOnPage = new Typecho_Widget_Helper_Form_Element_Checkbox('showOnPage', array(1 => _t('是的')), NULL, _t("是否在页面显示"), _t("文章版权选项"));
                $form->addInput($showOnPage);

            $form->addItem(new Typecho_Widget_Helper_Layout("/div"));
        $form->addItem(new Typecho_Widget_Helper_Layout("/div"));
    $form->addItem(new Typecho_Widget_Helper_Layout("/div"));