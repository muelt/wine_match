# ぐるなびAPI
    api_key = Rails.application.credentials.grunavi[:api_key]
    url = 'https://api.gnavi.co.jp/RestSearchAPI/v3/?keyid='
    url << api_key
    if params[:freeword]
      word = params[:freeword]
      url << "&name=" << word
    end
    url = URI.encode(url)
    uri = URI.parse(url)
    json = Net::HTTP.get(uri)
    result = JSON.parse(json)
    @rests = result["rest"]
    restaurant = eval("#{params[:restaurant]}")
    if params[:next]
      # お店を選択していない場合は同じページに戻る
      if params[:restaurant]
        session[:name] = restaurant["name"]
        session[:address] = restaurant["address"]
        session[:access] = restaurant["access"]["line"] + " " + restaurant["access"]["station"] + restaurant["access"]["station_exit"] + " 徒歩" + restaurant["access"]["walk"] + "分"
        session[:url] = restaurant["url"]
        session[:tel] = restaurant["tel"]
        session[:shop_image] = restaurant["image_url"]["shop_image1"]
        session[:opentime] = restaurant["opentime"]
        session[:holiday] = restaurant["holiday"]
        # step3をgetにしたためf.hiddenで渡せないので redirect_toのオプションでparamsを送る
        redirect_to admin_step3_path(event: event_params)
      else
        flash.now[:danger] = "お店を選択してください"
        render :step2
      end
    end
    render(:step1) && return if params[:back]
  end