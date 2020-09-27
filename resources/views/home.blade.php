
@extends('layouts.theme')

@section('title')
Home
@endsection

@section('body')

	<div class="col-7">
			
	@if(isset($aboutme))
	@if($aboutme->id !=null && $aboutme->user_id !=null  && $aboutme->school_id != null   &&$aboutme->sclass_id != null && $aboutme->contactNo != null && $aboutme->DOB != null )
		
	@else
	  @if(Auth::user()->role=="student")
	      <script>window.location = "{{route('student.edit', $aboutme->id)}}";</script>
	  @else(Auth::user()->role=="teacher")
          <script>window.location = "{{route('teacher.edit', $aboutme->id)}}";</script>
      @endif

	@endif
@endif
@if(Auth::user()->role=="student")
  @if(isset($aboutme))
	@if($aboutme->id !=null && $aboutme->user_id !=null  && $aboutme->school_id != null   &&$aboutme->sclass_id != null && $aboutme->contactNo != null && $aboutme->DOB != null )
	  
<div id="comedy">
	<h1 style="font-size: 480%;color: #b53a31">{{Auth::user()->student->relations()[1]->subject->name}}</h1> <br>
	<h5 style="color: #2e2c28">“Dear Math <br> I am sick and tired of finding your <strong>X <br></strong> just accept the fact that she is gone. Move on dude.” </h5><br><br>
	<h5 style="color: #2e2c28">“Exams are like GIRL FRIENDS:
		1. Too Many Questions. <br>
		2. Difficult to Understand. <br>
		3. More Explanation is Needed. <br>
		4. Result is always FAIL!.” </h5><br><br>
	<h5 style="color: #2e2c28">“ <strong>Teacher:</strong> Name the nation people hate most <br><strong>Student:</strong> Exami-nation....” </h5><br><br>
	<h5 style="color: #2e2c28">“Birth, Death comes once in life.. <br>
		Love comes once in life.. <br>
		Marriage comes once in life.. <br>
		But <br>
		Why does this bloody �EXAM� come again and again....” </h5><br><br>
	<h5 style="color: #2e2c28">“बाप – इतने कम मार्क्स , <br>
		दो थप्पड़ मारने चाहिए ,, <br>
		पप्पू – हाँ पापा जल्दी चलो <br>
		मैंने उस साले मास्टर का घर भी देख रखा है.” </h5><br><br>
	<h5 style="color: #2e2c28">“😃😃Maa bachche se : too  poora saal nahin padhata hai par jaisee hee 		tere exam paas aa jaata hai too khitaabon me kho jaata hai! <br>
		bachcha : kyonki laharon kee shaanti sabhee ko pasand hotee hai, <br>
		lekin tuphaano mein, naav lagaane mein maza hee kuchh aur hai <br>
		maan : idhar aa kutte tuje mai banaatee hu taitainik kee draivar !😄😃.” </h5><br><br>
	<h5 style="color: #2e2c28">“ <strong> Patient:</strong> Doctor, I have a pain in my eye whenever I 		drink tea. <br>
		<strong>Doctor:</strong> Take the spoon out of the mug before you drink.” </h5><br><br>
	<h5 style="color: #2e2c28">“<strong>A:</strong> Just look at that young person with the short hair 		and blue jeans. Is it a boy or a girl? <br>
		<strong>B:</strong> It's a girl. She's my daughter. <br>
		<strong>A:</strong> Oh, I'm sorry, sir. I didn't know that you were her father. <br>
		<strong>B:</strong> I'm not. I'm her mother..” </h5><br><br>
	<h5 style="color: #2e2c28">“A teacher asked a student to write 55. <br>
		Student asked: How? <br>
		<strong>Teacher :</strong> Write 5 and beside it another 5! <br>
		The student wrote 5 and stopped. <br>
		<strong>teacher :</strong> What are you waiting for? <br>
		<strong>student :</strong> I don't know which side to write the other 5!.” </h5><br><br>
	<h5 style="color: #2e2c28">“I dreamed I was forced to eat a giant marshmallow. <br>
		When I woke up, my pillow was gone..” </h5><br><br>
	<h5 style="color: #2e2c28">“ <strong>In view of Hareli Festival, there will no online classes 			tomorrow 20.07.2020.</strong> <br> grp mein mam ka ya msg bhejna k baad meara thank you! mam bolna k 	maan kr ra hai 😂😂🤪.” </h5><br><br>
	<h5 style="color:#2e2c28">“Teacher asked students to write something in copy.(few moments later)<br>
	    <strong>Teacher : </strong> What happen? why you are not writting? <br>
		<strong>Student : </strong>mam hindi mein bolo angerigi nahi aati.” </h5><br><br>
	<h5 style="color:#2e2c28">“Teacher asked students to write something in copy.(few moments later)<br>
	    <strong>Teacher : </strong> likh kyu nahi reha? <br>
		<strong>Student : </strong>mam kal jaha sa chooda tha wahi sa likhna hai?. <br>
		<strong>Teacher : </strong> yes <br>
		<strong>Student : </strong>lakin mam page mein jagha nhi hai kya kru?.” <br>
		few moments later teacher was in Hospital” </h5><br><br>
	<h5 style="color: #2e2c28">“ <strong>Teacher:</strong> Do you have trouble making decisions? <br>
 		<strong>Student:</strong> Well...yes and no..” </h5><br><br>
</div>
 <div id="motivational">
	<h1 style="font-size: 480%;color: #b53a31">something motivational</h1>
	    <h1 style="font-size: 300%">“always respect your teachers.” </h1><br>
		    <h5 style="color: #2e2c28">What else shall we do with teachers? <br>

				They taught you how to see the things which were INVISIBLE to you. <br>

				After your parents, they are the ones to be respected. <br>

				They shared their life experiences with you, which you will never find in the books, as most teachers are not authors of the book and most authors are not teachers. <br>

				Quite a few teachers inspire you to the extent that you go extra miles to surpass their limits and that's the point which makes them happy to the extent that they feel achieving their mission of life. <br>

				If you have encountered someone (teacher), whom you like to hate, then I feel sorry for you but I still suggest you love and respect him/her and with your nice behavior you can make him/her realize their mistake and that will be your achievement. <br>
			</h5>
		<h1 style="font-size: 300%">“Teachers can open the door,<br> but you must enter it yourself.” </h1><br>
			 <h5 style="color: #2e2c28">
				The world is a big place. There are many things to do, and many places to visit. But what if you don’t know about it, or have fears or worries about what you do know? <br>

				This is where a teacher can be helpful. They have been outside your limited world. They have seen, done, and learned things you don’t know or understand.The teacher can help you understand, and help you calm your fears. They can point out where and when to be cautious, and when and where to let go and have fun. <br>

				But after the teacher has taught you, it’s up to you to actually go out and do it. The teacher has opened the door, but only you can take the step through the door. <br>

				Walk through the door opens up so many other experiences. The recollections of your experience will come back the next time you read a book about the sea. Even TV shows have a greater impact when you have experienced some of the subject matter, instead of just reading about or listening to a teacher. <br>

				Just remember, we don’t have to walk through the door. We may find out something we thought would be fun really isn’t all that interesting. It’s fine to decline to cross the threshold. But we must also realize that it is our choice and our responsibility to choose to walk, or to not walk through the door. <br>

				The choice is yours, and you can always choose to reverse yourself if you don’t like what is happening. Part of being educated is noticing what happened and taking a moment to consider (or reconsider) what you did, and if you are willing to do it again. Sometimes once is enough. <br>
			</h5>
		<h1 style="font-size: 300%">“He who asks a question is a fool for five minutes; he who does not ask a question remains a fool forever.” </h1><br>
			<h5 style="color: #2e2c28">Always ask doubts in class don't be shy as the one who don't ask, in fear of being fool for few minutes is fool forever beacuse his/her concepts are always in doubt.</h5>
		<h1 style="font-size: 300%">“Education is the most powerful weapon you can use to change the world.” </h1><br>
			<h5 style="color: #2e2c28">Education provides you the tools to improve the quality of life in modern society both economically and sociologically. Education is power and no one can ever deny this fact. Education has the power to change your entire life. Starting from promoting gender equality to reducing poverty, it is one gesture in which you receive information and give systematic instructions in return. <br>

			So in order to be successful, you need education.
			</h5>
		<h1 style="font-size: 300%">“The way to get started is to quit talking and begin doing.” </h1><br> <br>
		<h1 style="font-size: 300%">“The man who does things makes many mistakes, but he never makes the biggest mistake of all—doing nothing.” </h1><br>
			<h5 style="color: #2e2c28">Always try doing something because from doing nothing in fear of fail, much better is to fail but try anything which is fair not wrong because if you will try you will get experience of it which no one can give you by doing the things you will get experience.All the books and people will give you theory from their experience but you have creat your own experience.
			</h5>
		<h1 style="font-size: 300%">“Learning is never done without errors and defeat.” </h1><br>
			<h5 style="color: #2e2c28">Don't fear or errors and defeat because:- <br>
			<strong> “I have not failed. I’ve just found 10,000 ways that won’t work.”</strong> – Thomas Edison <br>
			we never fail we just found the ways which doesn't work as the quote by Thomas Edison.</h5>
		<h1 style="font-size: 300%">“I find that the harder I work, the more luck I seem to have.”  </h1><br>
			<h5 style="color: #2e2c28">Don't believe in luck believe in hard work because where we do hard work you have done as hard work creates luck.</h5>
		<h1 style="font-size: 300%">“You are braver than you believe, stronger than you seem and smarter than you think.” </h1><br>
		    <h5 style="color: #2e2c28">Don't fear of anything. No one is capable of scarying you unless you fear.</h5>
		<h1 style="font-size: 300%">“Don't fear of defeat always proud on that you have participated in the game/competition because many people not even think of participate in fear of defeat.”</h1><br> <br>
		<h1 style="font-size: 300%">“Today a reader. Tomorrow a leader.” </h1><br>
			<h5 style="color: #2e2c28">Always read books. Books are the true friends of humans. By reading you will know about the thing and will gain the knowledge of books which will help you in your future times. While reading you are silent and the one who speak less and meaning full is always a leader.</h5>
		<h1 style="font-size: 300%">“They may forget what you said but they will not forget how you made		 them feel.” </h1><br>
			<h5 style="color: #2e2c28">Make people fell about what you want to tell them because fellings are the best way for understanding .</h5><br>
</div>
		
	@else
	
	To get homework, fill all your details by checking in <a href="{{route('student.index')}}"><strong>about me</strong></a> section. <br>
	thankyou!!

	@endif
  @endif
   
   <!-- <script>window.location = "{{route('homework.index')}}";</script> -->
<!-- if({{isset($student) ? $student->Qualification : ''}}) -->
@elseif(Auth::user()->role=="teacher")

  @if(isset($aboutme))
	@if($aboutme->id !=null && $aboutme->user_id !=null  && $aboutme->school_id != null   &&$aboutme->sclass_id != null && $aboutme->contactNo != null && $aboutme->DOB != null )
	
	<div id="comedy">
	<h1 style="font-size: 480%;color: #b53a31">Bored? Get something comedy</h1> <br>
	<h5 style="color: #2e2c28">“Dear Math <br> I am sick and tired of finding your <strong>X <br></strong> just accept the fact that she is gone. Move on dude.” </h5><br><br>
	<h5 style="color: #2e2c28">“Exams are like GIRL FRIENDS:
		1. Too Many Questions. <br>
		2. Difficult to Understand. <br>
		3. More Explanation is Needed. <br>
		4. Result is always FAIL!.” </h5><br><br>
	<h5 style="color: #2e2c28">“ <strong>Teacher:</strong> Name the nation people hate most <br><strong>Student:</strong> Exami-nation....” </h5><br><br>
	<h5 style="color: #2e2c28">“Birth, Death comes once in life.. <br>
		Love comes once in life.. <br>
		Marriage comes once in life.. <br>
		But <br>
		Why does this bloody �EXAM� come again and again....” </h5><br><br>
	<h5 style="color: #2e2c28">“बाप – इतने कम मार्क्स , <br>
		दो थप्पड़ मारने चाहिए ,, <br>
		पप्पू – हाँ पापा जल्दी चलो <br>
		मैंने उस साले मास्टर का घर भी देख रखा है.” </h5><br><br>
	<h5 style="color: #2e2c28">“😃😃Maa bachche se : too  poora saal nahin padhata hai par jaisee hee 		tere exam paas aa jaata hai too khitaabon me kho jaata hai! <br>
		bachcha : kyonki laharon kee shaanti sabhee ko pasand hotee hai, <br>
		lekin tuphaano mein, naav lagaane mein maza hee kuchh aur hai <br>
		maan : idhar aa kutte tuje mai banaatee hu taitainik kee draivar !😄😃.” </h5><br><br>
	<h5 style="color: #2e2c28">“ <strong> Patient:</strong> Doctor, I have a pain in my eye whenever I 		drink tea. <br>
		<strong>Doctor:</strong> Take the spoon out of the mug before you drink.” </h5><br><br>
	<h5 style="color: #2e2c28">“<strong>A:</strong> Just look at that young person with the short hair 		and blue jeans. Is it a boy or a girl? <br>
		<strong>B:</strong> It's a girl. She's my daughter. <br>
		<strong>A:</strong> Oh, I'm sorry, sir. I didn't know that you were her father. <br>
		<strong>B:</strong> I'm not. I'm her mother..” </h5><br><br>
	<h5 style="color: #2e2c28">“A teacher asked a student to write 55. <br>
		Student asked: How? <br>
		<strong>Teacher :</strong> Write 5 and beside it another 5! <br>
		The student wrote 5 and stopped. <br>
		<strong>teacher :</strong> What are you waiting for? <br>
		<strong>student :</strong> I don't know which side to write the other 5!.” </h5><br><br>
	<h5 style="color: #2e2c28">“I dreamed I was forced to eat a giant marshmallow. <br>
		When I woke up, my pillow was gone..” </h5><br><br>
	<h5 style="color: #2e2c28">“ <strong>In view of Hareli Festival, there will no online classes 			tomorrow 20.07.2020.</strong> <br> grp mein mam ka ya msg bhejna k baad meara thank you! mam bolna k 	maan kr ra hai 😂😂🤪.” </h5><br><br>
	<h5 style="color:#2e2c28">“Teacher asked students to write something in copy.(few moments later)<br>
	    <strong>Teacher : </strong> What happen? why you are not writting? <br>
		<strong>Student : </strong>mam hindi mein bolo angerigi nahi aati.” </h5><br><br>
	<h5 style="color:#2e2c28">“Teacher asked students to write something in copy.(few moments later)<br>
	    <strong>Teacher : </strong> likh kyu nahi reha? <br>
		<strong>Student : </strong>mam kal jaha sa chooda tha wahi sa likhna hai?. <br>
		<strong>Teacher : </strong> yes <br>
		<strong>Student : </strong>lakin mam page mein jagha nhi hai kya kru?.” <br>
		few moments later teacher was in Hospital” </h5><br><br>
	<h5 style="color: #2e2c28">“ <strong>Teacher:</strong> Do you have trouble making decisions? <br>
 		<strong>Student:</strong> Well...yes and no..” </h5><br><br>
	</div>
	<div id="motivational">
		<h1 style="font-size: 480%;color: #b53a31">something motivational</h1>
		<h1 style="font-size: 300%">“I am not a teacher, but an awakener..” </h1><br>
			<h5 style="color: #2e2c28">Teacher is the one who tell people about world.Teachers are the one who help their students in their way to sucess.They tell students about their qualities and make them fell that they are the best for everything they want in their life. Teachers make students think about anything which is the first step for success.</h5><br>
		<h1 style="font-size: 300%">“I find that the harder I work, the more luck I seem to have.”  </h1><br>
			<h5 style="color: #2e2c28">Don't believe in luck believe in hard work because where we do hard work you have done as hard work creates luck.</h5>
		<h1 style="font-size: 300%">“You are braver than you believe, stronger than you seem and smarter than you think.” </h1><br>
		    <h5 style="color: #2e2c28">Don't fear of anything. No one is capable of scarying you unless you fear.</h5>
		<h1 style="font-size: 300%">Don't fear of defeat always proud on that you have participated in the game/competition because many people not even think of participate in fear of defeat</h1><br> <br>
		<h1 style="font-size: 300%">“The man who does things makes many mistakes, but he never makes the biggest mistake of all—doing nothing.” </h1><br>
			<h5 style="color: #2e2c28">Always try doing something because from doing nothing in fear of fail, much better is to fail but try anything which is fair not wrong because if you will try you will get experience of it which no one can give you by doing the things you will get experience.All the books and people will give you theory from their experience but you have creat your own experience.
			</h5>
		<h1 style="font-size: 300%">“All students can learn and succeed, but not in the same way and 		not in the same day.” </h1><br> <br>
		<h1 style="font-size: 300%">“Today a reader. Tomorrow a leader.” </h1><br>
			<h5 style="color: #2e2c28">Always read books. Books are the true friends of humans. By reading you will know about the thing and will gain the knowledge of books which will help you in your future times. While reading you are silent and the one who speak less and meaning full is always a leader.</h5>
		<h1 style="font-size: 300%">“The way to get started is to quit talking and begin doing.” </h1><br><br>
		<h1 style="font-size: 300%">“The man who does things makes many mistakes, but he never makes the biggest mistake of all—doing nothing.” </h1><br>
			<h5 style="color: #2e2c28">Always try doing something because from doing nothing in fear of fail, much better is to fail but try anything which is fair not wrong because if you will try you will get experience of it which no one can give you by doing the things you will get experience.All the books and people will give you theory from their experience but you have creat your own experience.
			</h5>		
		<h1 style="font-size: 300%">“They may forget what you said but they will not forget how you made		 them feel.” </h1><br>
			<h5 style="color: #2e2c28">Make people fell about what you want to tell them because fellings are the best way for understanding .</h5><br>
		<h1 style="font-size: 300%">“Everyone who remembers his own education remembers teachers, not 			methods and techniques. The teacher is the heart of the educational system.” </h1><br>			<br>
		<h1 style="font-size: 300%">“The task of the modern educator is not to cut down jungles, but to 			irrigate deserts.” </h1><br>
			<h5 style="color: #2e2c28">Don't make students that they can't do anything don't scold them on their defeat they are also humans and mistakes are always done by humans only, make them fell that they can do whatever they want because no one is not more powerful then him/her except god.</h5><br>
		<h1 style="font-size: 300%">“The whole purpose of education is to turn mirrors into windows.”		</h1><br>
			<h5 style="color: #2e2c28">Children are mirrors from whose sight we can see ourselfs but not the whole world.We have to make them windows,from where we can see the world and the children will too develop the capability of seeing the whole world and understanding every situation and problems and to find its solutions of their own.</h5><br>
	</div>

	@else

	To give homework, fill all your details by checking in <a href="{{route('teacher.index')}}"><strong>about me</strong></a> section. <br>
	thankyou!! 

	@endif
@endif


@elseif(Auth::user()->role=="admin")

I am Admin

@endif
 
	</div>

	

@endsection





