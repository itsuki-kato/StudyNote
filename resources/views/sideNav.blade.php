
    <div class="sideNav">
        <div class="category_nav">
            <dt class="side_category">
                <span class="category_title">サイドカテゴリ</span>
                <i class="fa-solid fa-circle-chevron-down drop-down_icon"></i>
            </dt>
            <div class="category_wrapper">
                @foreach($Categories as $Category)
                    <div class="category_item1">
                        <a href="#">{{ $Category->name }}</a>
                        <input type="hidden" name="keyword" value="{{ $Category->id }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
