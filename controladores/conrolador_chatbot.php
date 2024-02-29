<script>
  window.watsonAssistantChatOptions = {
    integrationID: "0a818c4f-ec08-4699-8426-829a37bccb8d", // The ID of this integration.
    region: "au-syd", // The region your integration is hosted in.
    serviceInstanceID: "83930b76-7e0d-4ee4-908c-20523519e1d0", // The ID of your service instance.
    onLoad: function(instance) { instance.render(); }
  };
  setTimeout(function(){
    const t=document.createElement('script');
    t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
    document.head.appendChild(t);
  });
</script>