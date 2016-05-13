<form data-ng-submit="save();">
	<div 
		class="modal fade"
		id="edit-module" 
		data-keyboard="false"
		data-backdrop="static"
	>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button 
						type="button" 
						class="close" 
						data-dismiss="modal" 
					>
						<span>&times;</span>
					</button>
					<h4>
						<label data-ng-bind="header"></label>
					</h4>
		      	</div>
				<div class="modal-body">
					<span					
						id="element"
					>
					</span>
				</div>
				<div class="modal-footer">
					<div data-ng-show="!show_progress">
						<button 
							class="btn btn-default" 
							data-dismiss="modal"
						>
							Close
						</button>
						<button 
							class="btn btn-primary" 
							type="submit"
						>
							Yes
						</button>
					</div>
					<div 
						class="progress"
						data-ng-show="show_progress"
					>
						<div 
							class="progress-bar progress-bar-striped active" 
							style="width: 100%"
						></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>


