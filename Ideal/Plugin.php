<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * <strong style="color:#56a0e0;">小宇宙'blog 前台扩展功能插件</strong>
 * <div class="WechatFansSet"><br /><a href="https://803344.xyz/51.html/" title="插件因兴趣于闲暇时间所写，故会有代码不规范、不专业和  bug的情况，但完美主义促使代码还说得过去，如有bug或使用问题进行反馈即可。">鼠标轻触查看备注</a>&nbsp;<a href="https://803344.xyz/zfb.jpg" target="_blank">支付宝打赏</a>&nbsp;<a href="https://803344.xyz/51.html/" target="_blank">反馈</a></div><style>.WechatFansSet a{background: #4DABFF;padding: 5px;color: #fff;}</style>
 * @package Ideal 
 * @author 小宇宙
 * @version 1.3.2
 * @link http://803344.xyz
 */


require_once("libs/FormElements.php");


require_once ('libs/Checkbox.php');
require_once ('libs/Text.php');
require_once ('libs/Radio.php');
require_once ('libs/Select.php');
require_once ('libs/Textarea.php');



class Ideal_Plugin implements Typecho_Plugin_Interface {

    const STATIC_DIR = '/usr/plugins/Ideal/assets';
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {
        Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Ideal_Plugin', 'Ideal');
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->write = array('Ideal_Plugin', 'write');
        Typecho_Plugin::factory('Widget_Feedback')->comment = array('Ideal_Plugin', 'filter');
		Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Ideal_Plugin', 'ren12der');
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Ideal_Plugin', 'ren12der');
        return 'ideal已启用，进入设置开始迎接白富美！';

    }
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate() {

        return '你的白富美被ideal吃掉了';
    }
    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form) {
    //TODO:标题1：配置面板
    if (false){
       
EOF;

    }else{
        echo '
        <style type="text/css">
        .typecho-option span{
            margin-right:100%;
        }
        </style>
        ';
        $styleUrl = Helper::options()->pluginUrl . '/Ideal/assets/css/ideal.css';
        echo '<link rel="stylesheet" href=" '. $styleUrl .'"/>';
        $mduiUrl = Helper::options()->pluginUrl . '/Ideal/assets/js/mdui.min.js';
        echo '<script src=" '. $mduiUrl .'"></script>';
        echo '

    <div class="mdui-progress">
  </div> 
  
<div class="mdui-container">
  <div class="mdui-tab mdui-tab-scrollable mdui-tab-centered mdui-tab-full-width" mdui-tab>
    <a href="#example1-tab1" class="mdui-ripple">著作</a>
    <a href="#example1-tab2" class="mdui-ripple">说明</a>
    <a href="#example1-tab3" class="mdui-ripple">建议</a>
  </div>

  <div id="example1-tab1" class="mdui-p-a-2">
  <p>文章版权：作者：<a href="https://github.com/Yves-X/Copyright-for-Typecho/" target="_blank">Yves-X</a>；修复人：<a href="https://moe.best/" target="_blank">神代綺凜</a></p>
  <p>评论拦截：作者：<a href="http://www.yovisun.com/archive/typecho-plugin-smartspam.html/" target="_blank">Yovis Blog</a></p>
  <p>如果以下内容侵权了您的利益请联系：<a href="https://803344.xyz/" target="_blank">小宇宙</a></p>
  </div>
  <div id="example1-tab2" class="mdui-p-a-2">
      <p>我写这个插件主要是为了给自己方便，不用每次主题更新都需要手动修改文件的问题</p>
    <p>有部分功能是搬自其它的插件</p>
    <p>因为不想安装多个插件，或者原插件不合适自己</p>
  </div>
  <div id="example1-tab3" class="mdui-p-a-2">
    <p>可以通过您的建议的添加功能进来</p>
    <p>初衷：美化个人博客，不会添加一些不实际的</p>
    <p>联系方式.博客上留言：<a href="https://803344.xyz/" target="_blank">小宇宙</a></p>
  </div>
</div>
  ';

$form->addItem(new Ideal('<div class="mdui-panel mdui-panel-popout" mdui-panel>'));
$layout = new Typecho_Widget_Helper_Layout();
$layout->html(_t('<h4>开始配置:</h4><hr>'));
$form->addItem($layout);



//动态背景
$Bubbling= new Radio_ideal('Bubbling',array(
        '0' => "全部关闭",
        '1' => "开启动态冒泡",
        '2' => "这里暂时关闭",
        '3' => "开启动态彩带",
        '4' => "开启动态彩带CDN",
        '5' => "开启动态四方块",
        '6' => "舒适感的气泡",
        '7' => "缓慢上升气球",
    ),'0',"动态背景",("由jsdelivr提供CDN加速；<br>气泡.气球来自：萌卜兔"));
$form->addInput($Bubbling);

// 鼠标样式
$dir = self::STATIC_DIR . '/image';
    $options = [
    'none' => _t('系统默认'),
    'dew' => "<img src='{$dir}/dew/normal.cur'><img src='{$dir}/dew/link.cur'>",
    'carrot' => "<img src='{$dir}/carrot/normal.cur'><img src='{$dir}/carrot/link.cur'>",
    'exquisite' => "<img src='{$dir}/exquisite/normal.cur'><img src='{$dir}/exquisite/link.cur'>",
    'marisa' => "<img src='{$dir}/marisa/normal.cur'><img src='{$dir}/marisa/link.cur'>",
    'shark' => "<img src='{$dir}/shark/normal.cur'><img src='{$dir}/shark/link.cur'>",
    'sketch' => "<img src='{$dir}/sketch/normal.cur'><img src='{$dir}/sketch/link.cur'>",
    'star' => "<img src='{$dir}/star/normal.cur'><img src='{$dir}/star/link.cur'>",
    ];
    $bubbleType = new Radio_ideal('mouseType', $options, 'none', "鼠标样式");
$form->addInput($bubbleType);



$form->addItem(new Title_ideal('鼠标点击特效','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;加载jQuery库、气泡类型、文字气泡、气泡颜色、气泡速度'));
    $jquery = new Radio_ideal('jquery', [
        '0' => _t('不加载'),
        '1' => _t('加载')
    ],'0',"是否加载jQuery库", _t('插件需要jQuery库文件的支持，如果已加载就不需要加载了 jquery源是新浪：https://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js'));
        $form->addInput($jquery);
    $options = [
        'none' => _t('无'),
        'text' => _t('文字气泡'),
        'heart' => _t('爱心气泡'),
        'fireworks' => _t('fireworks+anime喷墨气泡'),
        ];
        $bubbleType = new Radio_ideal('bubbleType', $options, 'none', "气泡类型");
        $form->addInput($bubbleType);
    $bubbleText = new Text_ideal('bubbleText', null,"欢迎来到我的blog!", "文字气泡填写", "如果选择文字气泡类型, 请填写文字");
    $form->addInput($bubbleText);
    $bubbleColor = new Text_ideal('bubbleColor', null, "随机", "文字气泡颜色", "如果选择文字气泡类型, 请填写气泡颜色, 可填入<span style='color: red'>随机</span>或十六进制颜色值<span style='color: red'>#2db4d8</span>");
    $form->addInput($bubbleColor);
    $bubbleSpeed = new Text_ideal('bubbleSpeed', null, "3000","文字气泡速度","如果选择文字气泡类型, 请填写气泡速度 默认3秒");
    $form->addInput($bubbleSpeed);
$form->addItem(new EndSymbol_ideal(2));

$form->addItem(new Title_ideal('Handsome魔改样式','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;以下设置基于Handsome魔化,诺其它主题方可自测'));
$handsomecss = new Checkbox_ideal('handsomecss', array(
        'focus' => _t('首页悬停图片放大超出隐藏'),
        'rotation' => _t('鼠标经过头像转动并放大'),
        'Beat' => _t('文章底部赞赏图标跳动'),
        'slider' => _t('缩小滚动条滑块'),
        'commentTyping' => _t('评论框打字特效'),
        'Hovering' => _t('文章列表悬停上浮'),
        'centered' => _t('文章标题居中'),
        'typechoanniu' => _t('开启文章快捷语法'),
        'yijiandaka' => _t('评论添加一键打卡功能'),
        'bthovering' => _t('实验功能--H2-H6标题悬停美化(自定义主题色)'),
        'containers' => _t('实验功能--使用>引用变容器(自定义主题色)'),
        'ideal_code' => _t('实验功能--短代码美化(自定义主题色)'),
        'idealjc_img' => _t('文章相册,相册列表均加长'),
        'layertc' => _t('复制弹窗提示')
    ), NULL, "Handsome样式选项&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;实验功能", "实验功能可能会造成样式破坏,谨慎使用，标题悬停-引用容器-相册加长理论正常的");
$form->addInput($handsomecss);
    $Handsomezs = new Text_ideal('Handsomezs', null,"#d18f39", "实验功能&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主色", "如果未设置实验功能,该项就不会起到作用");
    $form->addInput($Handsomezs);
    $Handsomefs = new Text_ideal('Handsomefs', null,"#d18f39", "实验功能&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;辅色", "如果未设置实验功能,该项就不会起到作用");
    $form->addInput($Handsomefs);
    $Handsomeyys = new Text_ideal('Handsomeyys', null,"#d18f39", "实验功能&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阴影色", "如果未设置实验功能,该项就不会起到作用；注意：这里不能设置透明色。正确为：#ff0000。后台默认透明10%");
    $form->addInput($Handsomeyys);
    $layertcnr = new Text_ideal('layertcnr', null,"复制成功,欢迎使用Ideal插件！", "复制弹窗自定义内容", "如果复制弹窗提示未启用，则该内容无效！");
    $form->addInput($layertcnr);
$form->addItem(new EndSymbol_ideal(2));





$layout = new Typecho_Widget_Helper_Layout();
$layout->html(_t('<h5>增强插件:</h5><hr>'));
$form->addItem($layout);

    $isActive = new Radio_ideal('isActive',
        array(
            '1' => '是',
            '0' => '否',
        ),'0', "自动标签", "开启后,在新发布文章时;自动提取5个标签.");
    $form->addInput($isActive);

$form->addItem(new Title_ideal('文章版权','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：<a href="https://github.com/Yves-X/Copyright-for-Typecho/" target="_blank">Yves-X</a>；修复人：<a href="https://moe.best/" target="_blank">神代綺凜</a>'));
        $author = new Text_ideal('author', NULL, _t('小宇宙'),_t('文章作者'), NULL);
        $form->addInput($author);
        $notice = new Text_ideal('notice', NULL, _t('转载时须注明出处及本声明'), _t('文章声明'), _t('文章版权选项;根据自己意愿填写'));
        $form->addInput($notice);
        $showURL = new Checkbox_ideal('showURL', array(1 => _t('是的')), NULL, _t("显示链接"), NULL);
        $form->addInput($showURL);
        $showOnPost = new Checkbox_ideal('showOnPost', array(1 => _t('是的')), NULL, _t("文章显示"), NULL);
        $form->addInput($showOnPost);
        $showOnPage = new Checkbox_ideal('showOnPage', array(1 => _t('是的')), NULL, _t("页面显示"), NULL);
        $form->addInput($showOnPage);
$form->addItem(new EndSymbol_ideal(2));

$form->addItem(new Title_ideal('评论拦截','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;颜色区分（默认开启,自行配置）&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：<a href="http://www.yovisun.com/archive/typecho-plugin-smartspam.html/" target="_blank"> Yovis Blog</a>'));
        $opt_length = new Radio_ideal('opt_length', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #de1cc6'>评论字符长度操作</span>", "如果评论中长度不符合条件，则强行按该操作执行。如果选择[无动作]，将忽略下面长度的设置");
        $form->addInput($opt_length);       
        $length_min = new Text_ideal('length_min', NULL, '1', "<span style='color: #de1cc6'>最短字符</span>", '允许评论的最短字符数。');
        $length_min->input->setAttribute('class', 'mini');
        $form->addInput($length_min);
        $length_max = new Text_ideal('length_max', NULL, '200', "<span style='color: #de1cc6'>最长字符</span>", '允许评论的最长字符数');
        $length_max->input->setAttribute('class', 'mini');
        $form->addInput($length_max);
        $opt_ban = new Radio_ideal('opt_ban', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #FF0000'>禁止词汇操作</span>", "如果评论中包含禁止词汇列表中的词汇，将执行该操作");
        $form->addInput($opt_ban);
        $words_ban = new Textarea_ideal('words_ban', NULL, "傻逼\n操你妈\n智障\n傻子",
			"<span style='color: #FF0000'>禁止词汇表</span>", _t('多条词汇请用换行符隔开'));
        $form->addInput($words_ban);
        $opt_chk = new Radio_ideal('opt_chk', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #FF9797'>敏感词汇操作</span>", "如果评论中包含敏感词汇列表中的词汇，将执行该操作");
        $form->addInput($opt_chk);
        $words_chk = new Textarea_ideal('words_chk', NULL, "http://",
			"<span style='color: #FF9797'>敏感词汇表</span>", _t('多条词汇请用换行符隔开<br />注意：如果词汇同时出现于禁止词汇，则执行禁止词汇操作'));
        $form->addInput($words_chk);
        $opt_au_length = new Radio_ideal('opt_au_length', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #FF44FF'>昵称字符长度操作</span>", "如果昵称长度不符合条件，则强行按该操作执行。如果选择[无动作]，将忽略下面长度的设置");
        $form->addInput($opt_au_length);   
        $au_length_min = new Text_ideal('au_length_min', NULL, '1', "<span style='color: #FF44FF'>昵称最短字符数</span>", '昵称允许的最短字符数。');
        $au_length_min->input->setAttribute('class', 'mini');
        $form->addInput($au_length_min);
        $au_length_max = new Text_ideal('au_length_max', NULL, '20', "<span style='color: #FF44FF'>昵称最长字符数</span>", '昵称允许的最长字符数');
        $au_length_max->input->setAttribute('class', 'mini');
        $form->addInput($au_length_max);
        $opt_nojp_au = new Radio_ideal('opt_nojp_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #84C1FF'>昵称日文操作</span>", "如果用户昵称中包含日文，则强行按该操作执行");
        $form->addInput($opt_nojp_au);
        $opt_nourl_au = new Radio_ideal('opt_nourl_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #0072E3'>昵称网址操作</span>", "如果用户昵称是网址，则强行按该操作执行");
        $form->addInput($opt_nourl_au);
        $opt_au = new Radio_ideal('opt_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #B15BFF'>屏蔽昵称关键词操作</span>", "如果评论发布者的昵称含有该关键词，将执行该操作");
        $form->addInput($opt_au);
        $words_au = new Textarea_ideal('words_au', NULL, "",
			"<span style='color: #B15BFF'>屏蔽昵称关键词表</span>", _t('多个关键词请用换行符隔开'));
        $form->addInput($words_au);
        $opt_ip = new Radio_ideal('opt_ip', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #FF5809'>屏蔽IP操作</span>", "如果评论发布者的IP在屏蔽IP段，将执行该操作");
        $form->addInput($opt_ip);
        $words_ip = new Textarea_ideal('words_ip', NULL, "0.0.0.0",
			"<span style='color: #FF5809'>屏蔽IP</span>", _t('多条IP请用换行符隔开<br />支持用*号匹配IP段，如：192.168.*.*'));
        $form->addInput($words_ip);
        $opt_mail = new Radio_ideal('opt_mail', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #4F9D9D'>屏蔽邮箱操作</span>", "如果评论发布者的邮箱与禁止的一致，将执行该操作");
        $form->addInput($opt_mail);
        $words_mail = new Textarea_ideal('words_mail', NULL, "",
			"<span style='color: #4F9D9D'>邮箱关键词</span>", _t('多个邮箱请用换行符隔开<br />可以是邮箱的全部，或者邮箱部分关键词'));
        $form->addInput($words_mail);        
        $opt_url = new Radio_ideal('opt_url', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #AFAF61'>屏蔽网址操作</span>", "如果评论发布者的网址与禁止的一致，将执行该操作。如果网址为空，该项不会起作用。");
        $form->addInput($opt_url);
        $words_url = new Textarea_ideal('words_url', NULL, "",
			"<span style='color: #AFAF61'>网址关键词</span>", _t('多个网址请用换行符隔开<br />可以是网址的全部，或者网址部分关键词。如果网址为空，该项不会起作用。'));
        $form->addInput($words_url);
        $opt_title = new Radio_ideal('opt_title', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #743A3A'>内容含有文章标题</span>", "如果评论内容中含有本页面的文章标题，则强行按该操作执行");
        $form->addInput($opt_title);
        $opt_nojp = new Radio_ideal('opt_nojp', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #CF9E9E'>日文评论操作</span>", "如果评论中包含日文，则强行按该操作执行");
        $form->addInput($opt_nojp);
        $opt_nocn = new Radio_ideal('opt_nocn', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "waiting",
			"<span style='color: #CF9E9E'>非中文评论操作</span>", "如果评论中不包含中文，则强行按该操作执行");
        $form->addInput($opt_nocn);
$form->addItem(new EndSymbol_ideal(2));



$form->addItem(new Title_ideal('邮件通知','暂时还没有添加'));

$form->addItem(new EndSymbol_ideal(2));



$form->addItem(new Typecho_Widget_Helper_Layout("/div"));
        }
    }
    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form) {
    }
    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function Ideal($content, $widget, $lastResult) {
        $content = empty($lastResult) ? $content : $lastResult;
        $cr = self::apply($widget);
        $cr_html = self::render($cr);
        $content = $content . $cr_html;
        return $content;
    }
    private static function globalIdeal($widget) {
        $cr = array('show_on_post' => '', 'show_on_page' => '', 'show_url' => '', 'author' => '', 'url' => '', 'notice' => '');
        $cr['show_on_post'] = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->showOnPost;
        $cr['show_on_page'] = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->showOnPage;
        $cr['show_url'] = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->showURL[0];
        $cr['author'] = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->author;
        $cr['url'] = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->url;
        $cr['notice'] = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->notice;
        return $cr;
    }
    private static function localIdeal($widget) {
        $cr = array('switch_on' => '', 'author' => '', 'url' => '', 'notice' => '');
        $cr['switch_on'] = $widget->fields->switch;
        $cr['author'] = $widget->fields->author;
        $cr['url'] = $widget->fields->url;
        $cr['notice'] = $widget->fields->notice;
        return $cr;
    }
    private static function apply($widget) {
        $gcr = self::globalIdeal($widget);
        $lcr = self::localIdeal($widget);
        $cr = array('is_enable' => '', 'is_original' => '', 'author' => '', 'url' => '', 'notice' => '');
        if ($widget->is('single')) {
            $cr['is_enable'] = 1;
        }
        if ($widget->parameter->type == 'post' && $gcr['show_on_post'] == 0) {
            $cr['is_enable'] = 0;
        }
        if ($widget->parameter->type == 'page' && $gcr['show_on_page'] == 0) {
            $cr['is_enable'] = 0;
        }
        if ($lcr['switch_on'] != '') {
            $cr['is_enable'] = $lcr['switch_on'];
        }
        if ($gcr['show_url'] == 0) {
            $cr['url'] = 0;
        }
        $cr['url'] = $lcr['url'] != '' ? $lcr['url'] : $gcr['url'];
        if ($gcr['show_url'] == 1 && $lcr['url'] == '') {
            $cr['is_original'] = 1;
            $cr['url'] = $widget->permalink;
        }
        $cr['author'] = $lcr['author'] != '' ? $lcr['author'] : $gcr['author'];
        $cr['notice'] = $lcr['notice'] != '' ? $lcr['notice'] : $gcr['notice'];
        return $cr;
    }
    private static function render($cr) {
        $Ideal_html = '';
        $t_author = '';
        $t_notice = '';
        $t_url = '';
        if ($cr['is_enable']) {
            if ($cr['author']) {
                $t_author = '<p class="content-Ideal">版权属于：' . $cr['author'] . '</p>';
            }
            if ($cr['url']) {
                if ($cr['is_original']) {
                    $t_url = '<p class="content-Ideal">本文链接：<a class="content-Ideal" href="' . $cr['url'] . '">' . $cr['url'] . '</a></p>';
                } else {
                    $t_url = '<p class="content-Ideal">原文链接：<a class="content-Ideal" target="_blank" href="' . $cr['url'] . '">' . $cr['url'] . '</a></p>';
                }
            }
            if ($cr['notice']) {
                $t_notice = '<p class="content-Ideal">' . $cr['notice'] . '</p>';
            }
            $Ideal_html = '<hr class="content-Ideal" style="margin-top:50px" /><blockquote class="content-Ideal" style="font-style:normal">' . $t_author . $t_url . $t_notice . '</blockquote>';
        }
        return $Ideal_html;
    }
   

    /**
     * @param $Ideal
     * @return array
     */
    private static function handleBubbleType($Ideal) {
        $bubbleType = $Ideal->bubbleType;
        $dir  = self::STATIC_DIR;
        $js   = '';
        $html = '';
        switch ($bubbleType) {
            case 'text':
                $bubbleColor = $Ideal->bubbleColor;
                $bubbleSpeed = (int)$Ideal->bubbleSpeed;
                $bubbleText  = $Ideal->bubbleText;
                $js .= '<script>';
                $js .= <<<JS
var index = 0;
jQuery(document).ready(function() {
    $(window).click(function(e) {
        var string = "{$bubbleText}";
        var strings = string.split('');
        var span = $("<span>").text(strings[index]);
        index = (index + 1) % strings.length;
        var x = e.pageX,
        y = e.pageY;
        var color = "{$bubbleColor}";
        if (color == "随机") {
            var colorValue="0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f";
            var colorArray = colorValue.split(",");
            color="#";
            for(var i=0;i<6;i++){
                color+=colorArray[Math.floor(Math.random()*16)];
            }
        }
        span.css({
            "z-index": 999,
            "top": y - 20,
            "left": x,
            "position": "absolute",
            "font-weight": "bold",
            "color": color
        });
        $("body").append(span);
        var styles = {
            "top": y - 160,
            "opacity": 0
        };
        span.animate(styles, {$bubbleSpeed}, function() {
            span.remove();
        });
    });
});
JS;
                $js .= '</script>';
                break;
            case 'heart':
                $js .= '<script>';
                $js .= <<<JS
    // 鼠标点击爱心特效
    !function (e, t, a) {
        function r() {
            for (var e = 0; e < s.length; e++) {
                s[e].alpha <= 0 ? (t.body.removeChild(s[e].el), s.splice(e, 1)) : (s[e].y--, s[e].scale += .004, s[e].alpha -= .013, s[e].el.style.cssText = "left:" + s[e].x + "px;top:" + s[e].y + "px;opacity:" + s[e].alpha + ";transform:scale(" + s[e].scale + "," + s[e].scale + ") rotate(45deg);background:" + s[e].color + ";z-index:99999");
            }
            requestAnimationFrame(r)
        }

        function n() {
            var t = "function" == typeof e.onclick && e.onclick;
            e.onclick = function (e) {
                t && t(),
                    o(e)
            }
        }

        function o(e) {
            var a = t.createElement("div");
            a.className = "heart",
                s.push({
                    el: a,
                    x: e.clientX - 5,
                    y: e.clientY - 5,
                    scale: 1,
                    alpha: 1,
                    color: c()
                }),
                t.body.appendChild(a)
        }
        function i(e) {
            var a = t.createElement("style");
            a.type = "text/css";
            try {
                a.appendChild(t.createTextNode(e))
            } catch (t) {
                a.styleSheet.cssText = e
            }
            t.getElementsByTagName("head")[0].appendChild(a)
        }

        function c() {
            return "rgb(" + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + ")"
        }

        var s = [];
        e.requestAnimationFrame = e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || e.oRequestAnimationFrame || e.msRequestAnimationFrame ||
            function (e) {
                setTimeout(e, 1e3 / 60)
            },
            i(".heart{width: 10px;height: 10px;position: fixed;background: #f00;transform: rotate(45deg);-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);}.heart:after,.heart:before{content: '';width: inherit;height: inherit;background: inherit;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;position: fixed;}.heart:after{top: -5px;}.heart:before{left: -5px;}"),
            n(),
            r()
    }(window, document);
JS;
                $js .= '</script>';
                break;
            case 'fireworks':
                $html .= '<canvas id="fireworks" style="position:fixed;left:0;top:0;pointer-events:none;"></canvas>';
                $js   .= '<script type="text/javascript" src="https://cdn.bootcss.com/animejs/2.2.0/anime.min.js"></script>';
                $js   .= "<script type='text/javascript' src='{$dir}/js/fireworks.js'></script>";
                break;
        }
        $mouseType = $Ideal->mouseType;
        $imageDir  = self::STATIC_DIR . '/image';
        if ($mouseType != 'none') {
            $js .= '<script>';
            $js .= <<<JS
$("body").css("cursor", "url('{$imageDir}/{$mouseType}/normal.cur'), default");
$("a").css("cursor", "url('{$imageDir}/{$mouseType}/link.cur'), pointer");
JS;
            $js .= '</script>';
        }
        return compact('js', 'html');
}

    public static function filter($comment, $post) {
        $options = Typecho_Widget::widget('Widget_Options');
		$filter_set = $options->plugin('Ideal');
		$opt = "none";
		$error = "";
        
        
        //屏蔽评论内容包含文章标题
		if ($opt == "none" && $filter_set->opt_title != "none") {
			 $db = Typecho_Db::get();
            // 获取评论所在文章
            $po = $db->fetchRow($db->select('title')->from('table.contents')->where('cid = ?', $comment['cid']));        
            if(strstr($comment['text'], $po['title'])){
                $error = "对不起，评论内容不允许包含文章标题";
				$opt = $filter_set->opt_title;
            }        
		}
        

		//屏蔽IP段处理
		if ($opt == "none" && $filter_set->opt_ip != "none") {
			if (Ideal_Plugin::check_ip($filter_set->words_ip, $comment['ip'])) {
				$error = "评论发布者的IP已被管理员屏蔽";
				$opt = $filter_set->opt_ip;
			}			
		}       
        
        
        //屏蔽邮箱处理
		if ($opt == "none" && $filter_set->opt_mail != "none") {
			if (Ideal_Plugin::check_in($filter_set->words_mail, $comment['mail'])) {
				$error = "评论发布者的邮箱地址被管理员屏蔽";
				$opt = $filter_set->opt_mail;
			}			
		}  
        
        //屏蔽网址处理
        if(!empty($filter_set->words_url)){
            if ($opt == "none" && $filter_set->opt_url != "none") {
                if (Ideal_Plugin::check_in($filter_set->words_url, $comment['url'])) {
                    $error = "评论发布者的网址被管理员屏蔽";
                    $opt = $filter_set->opt_url;
                }			
            }
        }        
        
        
        //屏蔽昵称关键词处理
		if ($opt == "none" && $filter_set->opt_au != "none") {
			if (Ideal_Plugin::check_in($filter_set->words_au, $comment['author'])) {
				$error = "对不起，昵称的部分字符已经被管理员屏蔽，请更换";
				$opt = $filter_set->opt_au;
			}			
		}
        
        
        //日文评论处理
		if ($opt == "none" && $filter_set->opt_nojp != "none") {
			if (preg_match("/[\x{3040}-\x{31ff}]/u", $comment['text']) > 0) {
				$error = "禁止使用日文";
				$opt = $filter_set->opt_nojp;
			}
		}
        
        
        //日文用户昵称处理
		if ($opt == "none" && $filter_set->opt_nojp_au != "none") {
			if (preg_match("/[\x{3040}-\x{31ff}]/u", $comment['author']) > 0) {
				$error = "用户昵称禁止使用日文";
				$opt = $filter_set->opt_nojp_au;
			}
		}
        
        
        //昵称长度检测
		if ($opt == "none" && $filter_set->opt_au_length != "none") {            
            if(Ideal_Plugin::strLength($comment['author']) < $filter_set->au_length_min){           	
           		$error = "昵称请不得少于".$filter_set->au_length_min."个字符";
				$opt = $filter_set->opt_au_length;
            }else 
            if(Ideal_Plugin::strLength($comment['author']) >  $filter_set->au_length_max){           	
            	$error = "昵称请不得多于".$filter_set->au_length_max."个字符";
				$opt = $filter_set->opt_au_length;
            }
             
		}
        
        //用户昵称网址判断处理
		if ($opt == "none" && $filter_set->opt_nourl_au != "none") {
            if (preg_match(" /^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/ ", $comment['author']) > 0) {
				$error = "用户昵称不允许为网址";
				$opt = $filter_set->opt_nourl_au;
			}
		}
            
        
		//纯中文评论处理
		if ($opt == "none" && $filter_set->opt_nocn != "none") {
			if (preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
				$error = "评论内容请不少于一个中文汉字";
				$opt = $filter_set->opt_nocn;
			}
		}
        
        
        //字符长度检测
		if ($opt == "none" && $filter_set->opt_length != "none") {            
            if(Ideal_Plugin::strLength($comment['text']) < $filter_set->length_min){           	
           		$error = "评论内容请不得少于".$filter_set->length_min."个字符";
				$opt = $filter_set->opt_length;
            }else 
            if(Ideal_Plugin::strLength($comment['text']) >  $filter_set->length_max){           	
            	$error = "评论内容请不得多于".$filter_set->length_max."个字符";
				$opt = $filter_set->opt_length;
            }
             
		}
        
		//检查禁止词汇
		if ($opt == "none" && $filter_set->opt_ban != "none") {
			if (Ideal_Plugin::check_in($filter_set->words_ban, $comment['text'])) {
				$error = "评论内容中包含禁止词汇";
				$opt = $filter_set->opt_ban;
			}
		}
		//检查敏感词汇
		if ($opt == "none" && $filter_set->opt_chk != "none") {
			if (Ideal_Plugin::check_in($filter_set->words_chk, $comment['text'])) {
				$error = "评论内容中包含敏感词汇";
				$opt = $filter_set->opt_chk;
			}
		}

		//执行操作
		if ($opt == "abandon") {
			Typecho_Cookie::set('__typecho_remember_text', $comment['text']);
            throw new Typecho_Widget_Exception($error);
		}
		else if ($opt == "spam") {
			$comment['status'] = 'spam';
		}
		else if ($opt == "waiting") {
			$comment['status'] = 'waiting';
		}
		Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
    }
    
    /**
    * PHP获取字符串中英文混合长度 
    */
    private static function strLength($str){        
        preg_match_all('/./us', $str, $match);
        return count($match[0]);  // 输出9
    }
        
    /**
     * 检查$str中是否含有$words_str中的词汇
     * 
     */
	private static function check_in($words_str, $str) {
		$words = explode("\n", $words_str);
		if (empty($words)) {
			return false;
		}
		foreach ($words as $word) {
            if (false !== strpos($str, trim($word))) {
                return true;
            }
		}
		return false;
	}

    /**
     * 检查$ip中是否在$words_ip的IP段中
     * 
     */
	private static function check_ip($words_ip, $ip) {
		$words = explode("\n", $words_ip);
		if (empty($words)) {
			return false;
		}
		foreach ($words as $word) {
			$word = trim($word);
			if (false !== strpos($word, '*')) {
				$word = "/^".str_replace('*', '\d{1,3}', $word)."$/";
				if (preg_match($word, $ip)) {
					return true;
				}
			} else {
				if (false !== strpos($ip, $word)) {
					return true;
				}
			}
		}
		return false;
    }
    public static function write($contents, $edit) {
        $html = $contents['text'];
        $isMarkdown = (0 === strpos($html, '<!--markdown-->'));
        if($isMarkdown){
            $html = Markdown::convert($html);
        }
        $text = str_replace("\n", '', trim(strip_tags(html_entity_decode($html))));
        $Ideal = Typecho_Widget::widget('Widget_Options')->plugin('Ideal');
        //插件启用,且未手动设置标签
        if($Ideal->isActive == 1 && !$contents['tags']) {
            Typecho_Widget::widget('Widget_Metas_Tag_Admin')->to($tags);
            foreach($tags->stack as $tag){
                $tagNames[] = $tag['name'];
            }
            //str_replace("\n", '', trim(strip_tags($contents['text'])))
            //过滤 html 标签等无用内容
            $postString = json_encode($text);
            $ch = curl_init('http://api.bosonnlp.com/tag/analysis?space_mode=0&oov_level=0&t2s=0');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postString);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'X-Token: fpm1fDvA.5220.GimJs8QvViSK'
                )
            );
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result);
            $ignoreTag = array('w', 'wkz', 'wky', 'wyz', 'wyy', 'wj', 'ww', 'wt', 'wd', 'wf', 'wn', 'wm', 'ws', 'wp', 'wb', 'wh', 'email', 'tel', 'id', 'ip', 'url', 'o', 'y', 'u', 'uzhe', 'ule', 'ugou', 'ude', 'usou', 'udeng', 'uyy', 'udh', 'uzhi', 'ulian', 'c', 'p', 'pba', 'pbei', 'd', 'dl', 'q', 'm', 'r', 'z', 'b', 'bl', 'a', 'ad', 'an', 'al', 'v', 'vd', 'vshi', 'vyou', 'vl', 'f', 's', 't', 'nl');
            $sourceTags = array();
            foreach($result[0]->tag as $key => $tag){
                if(!in_array($tag, $ignoreTag)){
                    if(in_array($result[0]->word[$key], $tagNames)){
                        if(in_array($result[0]->word[$key], $sourceTags)) continue;
                        $sourceTags[] = $result[0]->word[$key];
                    }
                }
            }
            $contents['tags'] = implode(',', array_unique($sourceTags));
            if(count($contents['tags'])<3){
                $ch = curl_init('http://api.bosonnlp.com/keywords/analysis?top_k=5');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS,$postString);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'X-Token: fpm1fDvA.5220.GimJs8QvViSK'
                    )
                );
                $result = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($result);
                foreach($result as $re){
                    $a[] = $re[1];
                }
                $contents['tags'] = $contents['tags']?$contents['tags'].','.implode(',', $a):implode(',', $a);
            }
        }
        return $contents;
    }

    public static function header(){
        $zhutise = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->Handsomezs;
        $fuzhuse = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->Handsomefs;
        $yinyingse = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->Handsomeyys;
        $focus = '.index-post-img{overflow:hidden}.item-thumb{transition:all .3s}.item-thumb:hover{transform:scale(1.1)}';
        $rotation = '.img-full{width:100px;border-radius:50%;animation:light 4s ease-in-out infinite;transition:.5s}.img-full:hover{transform:scale(1.15) rotate(720deg)}@keyframes light{0%{box-shadow:0 0 4px red}25%{box-shadow:0 0 16px #0f0}50%{box-shadow:0 0 4px #00f}75%{box-shadow:0 0 16px #0f0}100%{box-shadow:0 0 4px red}}';
        $Beat = '.btn-pay{animation:star .5s ease-in-out infinite alternate}@keyframes star{from{transform:scale(1)}to{transform:scale(1.1)}}';
        $slider = '::-webkit-scrollbar{width:3px;height:16px;background-color:rgba(255,255,255,0)}::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);border-radius:10px;background-color:rgba(255,255,255,0)}::-webkit-scrollbar-thumb{border-radius:10px;-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);background-color:#555}';
        $Hovering = '.blog-post .panel:not(article){transition:all .3s}.blog-post .panel:not(article):hover{transform:translateY(-10px);box-shadow:0 8px 10px rgba(73,90,47,.47)}';
        $centered = '.panel h2{text-align:center}.post-item-foot-icon{text-align:center}';
        $bthovering = '#post-content h1,#post-content h2,#post-content h3,#post-content h4,#post-content h5,#post-content h6{position:relative;margin:20px 0 32px!important;color:#8492a6!important;-webkit-transition:.25s!important;transition:.25s!important}#post-content h2:before,#post-content h3:before,#post-content h4:before,#post-content h5:before,#post-content h6:before{content:"";position:absolute;left:0;bottom:-8px;display:block;width:30px;height:3px;background:-webkit-gradient(linear,left top,left bottom,color-stop(30%,' . $fuzhuse . '),color-stop(70%,' . $zhutise . '));background:linear-gradient(' . $fuzhuse . ' 30%,' . $zhutise . ' 70%);box-shadow:0 3px 12px ' . $yinyingse . ' !important;border-radius:4px;-webkit-transition:.25s;transition:.25s;z-index:1}#post-content h2:hover:before,#post-content h3:hover:before,#post-content h4:hover:before,#post-content h5:hover:before,#post-content h6:hover:before{content:"";position:absolute;display:block;width:3em;height:4px;background-color:#eff2f7;left:0;bottom:-7px}';
        $containers = 'blockquote{position:relative;margin:28px 0 16px!important;padding:10px 20px!important;width:-webkit-fit-content!important;width:-moz-fit-content!important;width:fit-content!important;max-width:100%!important;border-radius:10px!important;color:#fff!important;text-shadow:0 -1px ' . $zhutise . '!important;box-shadow:0 3px 12px ' . $yinyingse . '!important;background:-webkit-gradient(linear,left top,right top,from(' . $zhutise . '),to(' . $fuzhuse . '))!important;background:linear-gradient(90deg,' . $zhutise . ',' . $fuzhuse . ')!important}#post-content blockquote{border-left:3px solid #cd59d2!important;width:100%!important}';
        $ideal_code = 'code{background-color:' . $yinyingse . '10!important;border-radius:4px!important;font-size:14px!important}';
        $idealjc_img = '.album-thumb,.image-thumb{height:232px!important}.img-wrap{height:200px!important}';
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('focus', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $focus . '
            </style>';
        endif;
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('rotation', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $rotation . '
            </style>';
        endif;
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('Beat', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $Beat . '
            </style>';
        endif;
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('slider', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $slider . '
            </style>';
        endif;
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('Hovering', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $Hovering . '
            </style>';
        endif;
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('centered', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $centered . '
            </style>';
        endif;

        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('bthovering', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $bthovering . '
            </style>';
        endif;
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('containers', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $containers . '
            </style>';
        endif;
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('ideal_code', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $ideal_code . '
            </style>';
        endif;
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('idealjc_img', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '
            <style type="text/css">
            ' . $idealjc_img . '
            </style>';
        endif;
    }

    public static function footer() {
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('yijiandaka', Helper::options()->plugin('Ideal')->handsomecss)):
        ?>
        <script type="text/javascript">
                function a(a, b, c) {
                        if (document.selection) a.focus(), sel = document.selection.createRange(), c ? sel.text = b + sel.text + c : sel.text = b, a.focus();
                        else if (a.selectionStart || "0" == a.selectionStart) {
                            var l = a.selectionStart,
                                m = a.selectionEnd,
                                n = m;
                            c ? a.value = a.value.substring(0, l) + b + a.value.substring(l, m) + c + a.value.substring(m, a.value.length) : a.value = a.value.substring(0, l) + b + a.value.substring(m, a.value.length);
                            c ? n += b.length + c.length : n += b.length - m + l;
                            l == m && c && (n -= c.length);
                            a.focus();
                            a.selectionStart = n;
                            a.selectionEnd = n
                        } else a.value += b + c, a.focus()
                }
                var b = (new Date).toLocaleTimeString(),
                        c = document.getElementById("comment") || 0;
                window.SIMPALED = {};
                window.SIMPALED.Editor = {
                    daka: function() {
                        a(c, "滴！学生卡！打卡时间：" + b, "，请上车的乘客系好安全带~")
                    },
                    zan: function() {
                        a(c, " 写得好好哟,我要给你生猴子！::funny:04:: ")
                    },
                    cai: function() {
                        a(c, "骚年,我怀疑你写了一篇假的文章！::funny:03:: ")
                    }
                };
            $(function(){
                $(".OwO").after("<div class=\"OwO\" title=\"打卡\" onclick=\"javascript:SIMPALED.Editor.daka();this.style.display='none'\"><div class=\"OwO-logo\"><i class=\"fontello-pencil\"></i><span class=\"OwOlogotext\"></span></div></div><div class=\"OwO\" title=\"赞\"  onclick=\"javascript:SIMPALED.Editor.zan();this.style.display='none'\"><div class=\"OwO-logo\"><i class=\"glyphicon glyphicon-thumbs-up\"></i><span class=\"OwOlogotext\"></span></div></div><div class=\"OwO\" title=\"踩\"  onclick=\"javascript:SIMPALED.Editor.cai();this.style.display='none'\"><div class=\"OwO-logo\"><i class=\"glyphicon glyphicon-thumbs-down\"></i><span class=\"OwOlogotext\"></span></div></div>");
                //选择 ID 为 #two 的 DIV 节点，在其后边添加一个 DIV 节点
                $(".OwO").css("display","inline")
            });
		</script>
        <?php
        endif;
        
        
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('layertc', Helper::options()->plugin('Ideal')->handsomecss)):
        ?>
        <script src="//lib.baomitu.com/layer/3.1.1/layer.js"></script>
        <script type="text/javascript">
            document.body.oncopy = function() {layer.msg('<?php $layertcnr = Typecho_Widget::widget('Widget_Options')->plugin('Ideal')->layertcnr; echo $layertcnr;?>');};
		</script>
        <?php
        endif;



        // 动态彩带
        $Bubbling = Helper::options()->plugin('Ideal')->Bubbling;
        if($Bubbling == 0) {
            // 关闭
        }
        if($Bubbling == 1) {
            // 动态冒泡
            echo '<div id="bubble"></div><script>class BGBubble{constructor(i){this.defaultOpts={id:"",num:100,start_probability:.1,radius_min:1,radius_max:2,radius_add_min:.3,radius_add_max:.5,opacity_min:.3,opacity_max:.5,opacity_prev_min:.003,opacity_prev_max:.005,light_min:40,light_max:70,is_same_color:!1,background:"#f1f3f4"},"[object Object]"==Object.prototype.toString.call(i)?this.userOpts={...this.defaultOpts,...i}:this.userOpts={...this.defaultOpts,id:i},this.color=this.random(0,360),this.bubbleNum=[],this.requestAnimationFrame=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame,this.cancelAnimationFrame=window.cancelAnimationFrame||window.mozCancelAnimationFrame}random(i,t){return Math.random()*(t-i)+i}initBubble(i,t){const a=window.innerWidth,s=window.innerHeight,n=this.userOpts,e=this.random(n.light_min,n.light_max);this.bubble={x:this.random(0,a),y:this.random(0,s),radius:this.random(n.radius_min,n.radius_max),radiusChange:this.random(n.radius_add_min,n.radius_add_max),opacity:this.random(n.opacity_min,n.opacity_max),opacityChange:this.random(n.opacity_prev_min,n.opacity_prev_max),light:e,color:`hsl(${t?i:this.random(0,360)},100%,${e}%)`}}bubbling(i,t,a){!this.bubble&&this.initBubble(t,a);const s=this.bubble;i.fillStyle=s.color,i.globalAlpha=s.opacity,i.beginPath(),i.arc(s.x,s.y,s.radius,0,2*Math.PI,!0),i.closePath(),i.fill(),i.globalAlpha=1,s.opacity-=s.opacityChange,s.radius+=s.radiusChange,s.opacity<=0&&this.initBubble(t,a)}createCanvas(){this.canvas=document.createElement("canvas"),this.ctx=this.canvas.getContext("2d"),this.canvas.style.display="block",this.canvas.width=window.innerWidth,this.canvas.height=window.innerHeight,this.canvas.style.position="fixed",this.canvas.style.top="0",this.canvas.style.left="0",this.canvas.style.zIndex="-1",document.getElementById(this.userOpts.id).appendChild(this.canvas),window.onresize=(()=>{this.canvas.width=window.innerWidth,this.canvas.height=window.innerHeight})}start(){const i=window.innerWidth,t=window.innerHeight;this.color+=.1,this.ctx.fillStyle=this.defaultOpts.background,this.ctx.fillRect(0,0,i,t),this.bubbleNum.length<this.userOpts.num&&Math.random()<this.userOpts.start_probability&&this.bubbleNum.push(new BGBubble),this.bubbleNum.forEach(i=>i.bubbling(this.ctx,this.color,this.userOpts.is_same_color));const a=this.requestAnimationFrame;this.myReq=a(()=>this.start())}destory(){(0,this.cancelAnimationFrame)(this.myReq),window.onresize=null}}const bubbleDemo=new BGBubble("bubble");bubbleDemo.createCanvas(),bubbleDemo.start();</script> ' . PHP_EOL;
        }
        if($Bubbling == 2) {
            // 动态冒泡cdn
        }
        if($Bubbling == 3) {
            // 动态彩带
            $jsUrl = Helper::options()->pluginUrl . '/Ideal/assets/js/ribbon-dynamic.js';
            echo '<script type="text/javascript" src="' . $jsUrl . '" async defer></script>' . PHP_EOL;
        }
        if($Bubbling == 4) {
            // 动态彩带
            echo '<script type="text/javascript" src="//cdn.jsdelivr.net/gh/guugg/typecho/assets/ideal/ribbon-dynamic.js" async defer></script>' . PHP_EOL;
        }
        if($Bubbling == 5) {
            // 四方块
            $starlight = Helper::options()->pluginUrl . '/Ideal/assets/js/starlight.js';
            echo '<script type="text/javascript" src="' . $starlight . '" async defer></script>' . PHP_EOL;
        }
        if($Bubbling == 6) {
            // 圈圈
            $PinkBubble = Helper::options()->pluginUrl . '/Ideal/assets/js/PinkBubble.js';
            echo '<script type="text/javascript" src="' . $PinkBubble . '" async defer></script>' . PHP_EOL;
        }
        if($Bubbling == 7) {
            // 气球
            $RiseBalloon = Helper::options()->pluginUrl . '/Ideal/assets/js/RiseBalloon.js';
            echo '<script type="text/javascript" src="' . $RiseBalloon . '" async defer></script>' . PHP_EOL;
        }
        
        //点击爱心
        $Ideal = Helper::options()->plugin('Ideal');
        $jquery = $Ideal->jquery;
        if ($jquery) {
            echo '<script type="text/javascript" src="//lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>';
        }
        $arr = self::handleBubbleType($Ideal);
        echo $arr['html'];
        echo $arr['js'];

            $commentTyping = Helper::options()->pluginUrl . '/Ideal/assets/js/commentTyping.js';
            if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('commentTyping', Helper::options()->plugin('Ideal')->handsomecss)):
            echo '<script type="text/javascript" src="' . $commentTyping . '" async defer></script>' . PHP_EOL;
            endif;
    }
    
    // 自定快捷语法
    public static function ren12der() {
        if (!empty(Helper::options()->plugin('Ideal')->handsomecss) && in_array('typechoanniu', Helper::options()->plugin('Ideal')->handsomecss)):
       ?>
        <style type="text/css">
        .app-footer{position:fixed;bottom:0;width:100%;background-color:#edf1f2;color:#58666e;border-top:1px solid #dee5e7}.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:500;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:2px outline: 0!important}.btn-default{color:#58666e!important;background-color:#fcfdfd;background-color:#fff;border-color:#dee5e7;border-bottom-color:#d8e1e3;-webkit-box-shadow:0 1px 1px rgba(90,90,90,.1);box-shadow:0 1px 1px rgba(90,90,90,.1)}
        </style>
        <!-- 样式按钮 -->
        <footer class="app-footer">
        <button class="btn btn-default" id="wmd-button-wechatfans">默认按钮</button>
        <button class="btn btn-default" id="wmd-link-button">添加链接</button>
        <button class="btn btn-default" id="wmd-image-button">插入图片</button>
        <button class="btn btn-default" id="wmd-hplayer-button">插入音乐</button>
        <button class="btn btn-default" id="wmd-video-button">插入视频</button>
        <button class="btn btn-default" id="wmd-post-button">调用文章</button>
        <button class="btn btn-default" id="wmd-button-button">插入按钮</button>
        <button class="btn btn-default" id="wmd-text-button">高亮文本</button>
        <button class="btn btn-default" id="wmd-yc1-button">评论可见</button>
        <button class="btn btn-default" id="wmd-yc2-button">登陆可见</button>
        <button class="btn btn-default" id="wmd-tab-button">插入标签</button>
        <button class="btn btn-default" id="wmd-album-button">文章相册</button>
        <button class="btn btn-default" id="wmd-web-llq">灯箱浏览器</button>
        </footer>
        <!-- 输出代码 -->
		<script type="text/javascript">
			$(function(){
				$(document).on('click', '#wmd-button-wechatfans', function(){
					$('#text').val($('#text').val()+'\r\n<!--扩展-->\r\n\r\n<!--扩展-->');
                });
                $(document).on('click', '#wmd-web-llq', function(){
					$('#text').val($('#text').val()+'<a data-fancybox="iframe" data-src="完整链接" data-type="iframe" href="javascript:;">输入Ideal标题</a>');
				});
			});
		</script>
		<?php
        endif;
       
    }

    public static function Comments() {
        // 动态彩带
        ?>
		<script type="text/javascript">
            $(function(){

                $(".OwO").after("<div>我是新添加的内容</div>");

                //选择 ID 为 #two 的 DIV 节点，在其后边添加一个 DIV 节点
                $(".OwO").css("display","inline")
            });
		</script>
        <?php    
    }
    
}