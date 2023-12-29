"use strict";
!function(){
  var a=document.querySelector("#TagifyBasic"),
  a=(new Tagify(a),
  document.querySelector("#TagifyReadonly")),
  a=(new Tagify(a),
  document.querySelector("#TagifyCustomInlineSuggestion")),
  e=document.querySelector("#TagifyCustomListSuggestion"),
  t=["A# .NET","A# (Axiom)","A-0 System","A+","A++","ABAP","ABC","ABC ALGOL","ABSET","ABSYS","ACC","Accent","Ace DASL","ACL2","Avicsoft","ACT-III","Action!","ActionScript","Ada","Adenine","Agda","Agilent VEE","Agora","AIMMS","Alef","ALF","ALGOL 58","ALGOL 60","ALGOL 68","ALGOL W","Alice","Alma-0","AmbientTalk","Amiga E","AMOS","AMPL","Apex (Salesforce.com)","APL","AppleScript","Arc","ARexx","Argus","AspectJ","Assembly language","ATS","Ateji PX","AutoHotkey","Autocoder","AutoIt","AutoLISP / Visual LISP","Averest","AWK","Axum","Active Server Pages","ASP.NET"],
  a=(new Tagify(a,{
    whitelist:t,
    maxTags:1000,
    dropdown:{
      maxItems:2000,
      classname:"tags-inline",
      enabled:0,
      closeOnSelect:!1
    }
  }),new Tagify(e,{
    whitelist:t,
    maxTags:1000,
    dropdown:{
      maxItems:2000,
      classname:"",
      enabled:0,
      closeOnSelect:!1
    }
  }),
  document.querySelector("#TagifyUserList"));

  let i=new Tagify(a,{
    tagTextProp:"name",
    enforceWhitelist:!0,
    skipInvalid:!0,
    dropdown:{
      closeOnSelect:!1,
      enabled:0,
      classname:"users-list",
      searchKeys:["name","email"]
    },templates:{
      tag:function(a){return`
    <tag title="${a.title||a.email}"
      contenteditable='false'
      spellcheck='false'
      tabIndex="-1"
      class="${this.settings.classNames.tag} ${a.class||""}"
      ${this.getAttributes(a)}
    >
      <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
      <div>
        <div class='tagify__tag__avatar-wrap'>
          <img onerror="this.style.visibility='hidden'" src="${a.avatar}" loading="lazy">
        </div>
        <span class='tagify__tag-text'>${a.name}</span>
      </div>
    </tag>
  `},dropdownItem:function(a){return`
    <div ${this.getAttributes(a)}
      class='tagify__dropdown__item align-items-center ${a.class||""}'
      tabindex="0"
      role="option"
    >
      ${a.avatar?`<div class='tagify__dropdown__item__avatar-wrap'>
          <img onerror="this.style.visibility='hidden'" src="${a.avatar}" loading="lazy">
        </div>`:""}
      <strong>${a.name}</strong>
      <span>${a.email}</span>
    </div>
  `}},
  whitelist:
  <?php
  $conn = $pdo->open();

  try{
    $i = 1;
    $stmt = $conn->prepare("SELECT * FROM users WHERE type = 0 AND contact_info != ''");
    $stmt->execute();

    echo "[";
    foreach($stmt as $users){ $i++;
      if ($users['photo'] == "") {
        $img = $settings['site_url'].'assets/img/avatars/profile.jpg';
      }
      elseif ($users['google_id'] !== "") {
        $img = $users['photo'];
      }
      else{
        $img = $settings['site_url'].'assets/img/avatars/'.$users['photo'];
      }
      ?>
      {
        value:<?php echo $i++; ?>,
        name:"<?php echo $users['firstname'].' '.$users['lastname']; ?>",
        avatar:"<?php echo $img; ?>",
        email:"<?php echo $users['contact_info']; ?>"
      },
  <?php
}
echo '{
  value:1,
  name:"'.$settings['site_name'].'",
  avatar:"'.$settings['site_url'].'assets/img/core/'.$settings['favicon'].'",
  email:"'.$about['phone'].'"
}]';
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  $pdo->close();
  ?>
});

i.on("dropdown:show dropdown:updated",
function(a){
  a=a.detail.tagify.DOM.dropdown.content;
  1<i.suggestedListItems.length&&(n=i.parseTemplate("dropdownItem",[{
    class:"addAll",name:"Add all",email:i.settings.whitelist.reduce(function(a,e){return i.isTagDuplicate(e.value)?a:a+1},0)+" Users"
  }]),
  a.insertBefore(n,a.firstChild))
}),
i.on("dropdown:select",function(a){
  a.detail.elm==n&&i.dropdown.selectAll.call(i)
});
let n;
e=Array.apply(null,Array(100)).map(function(){
  return Array.apply(null,Array(~~(10*Math.random()+3))).map(function(){return String.fromCharCode(26*Math.random()+97)}).join("")+"@gmail.com"
});
const l=document.querySelector("#TagifyEmailList"),
r=new Tagify(l,{
  pattern:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
  whitelist:e,
  callbacks:{
    invalid:function(a){
      console.log("invalid",a.detail)
    }
  },
  dropdown:{
    position:"text",
    enabled:1
  }
}),
s=l.nextElementSibling;
s.addEventListener("click",function(){
  r.addEmptyTag()
})
}();
